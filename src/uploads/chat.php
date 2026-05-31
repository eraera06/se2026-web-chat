<?php
require_once "config/session.php";
requireLogin();
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>WebChat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-white h-screen overflow-hidden">

<div class="flex h-screen">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-slate-900 border-r border-white/10 p-4 flex flex-col">
        <h1 class="text-3xl font-bold mb-2 text-teal-400">WebChat</h1>

        <p class="text-sm text-gray-400 mb-6">
            Logged in as:
            <b class="text-white"><?php echo $_SESSION['username']; ?></b>
        </p>

        <h2 class="text-xs uppercase text-gray-500 mb-3 tracking-widest">
            Përdoruesit
        </h2>

        <div id="usersList" class="space-y-2 flex-1 overflow-y-auto"></div>

        <a href="logout.php"
           class="mt-4 bg-red-600 hover:bg-red-700 text-center p-3 rounded-xl font-bold">
            Logout
        </a>
    </aside>

    <!-- CHAT AREA -->
    <main class="flex-1 flex flex-col bg-slate-950">

        <!-- HEADER -->
        <header class="p-4 bg-slate-900 border-b border-white/10">
            <h2 id="chatTitle" class="text-xl font-bold">
                Zgjidh një përdorues
            </h2>
            <p class="text-sm text-gray-500">
                Mesazhet shfaqen pa refresh me AJAX polling
            </p>
        </header>

        <!-- MESSAGES -->
        <section id="messages"
                 class="flex-1 p-6 overflow-y-auto space-y-3 bg-slate-950">
            <div class="text-center text-gray-500 mt-20">
                Zgjidh një përdorues nga lista për të nisur bisedën.
            </div>
        </section>

        <!-- INPUT -->
        <form id="messageForm"
              class="p-4 bg-slate-900 border-t border-white/10 flex gap-3">

            <input id="messageInput"
                   type="text"
                   placeholder="Shkruaj mesazhin..."
                   autocomplete="off"
                   class="flex-1 p-4 rounded-2xl bg-white/10 text-white outline-none focus:ring-2 focus:ring-teal-400">

            <button type="submit"
                    class="bg-teal-400 hover:bg-teal-300 text-black px-8 rounded-2xl font-bold">
                Send
            </button>
        </form>

    </main>

</div>

<script>
let currentChatId = null;
let currentUserId = <?php echo $_SESSION['user_id']; ?>;
let lastMessagesJson = "";

// =========================
// LOAD USERS
// =========================
function loadUsers() {
    fetch("api/get_users.php")
        .then(res => res.json())
        .then(users => {
            let html = "";

            if (users.length === 0) {
                html = `<p class="text-gray-500 text-sm">Nuk ka përdorues të tjerë.</p>`;
            }

            users.forEach(user => {
                html += `
                    <button onclick="openChat(${user.id}, '${user.username}')"
                        class="w-full text-left p-3 rounded-xl bg-white/5 hover:bg-teal-400/20 transition">
                        <div class="font-semibold">${user.username}</div>
                        <div class="text-xs text-gray-500">Kliko për chat</div>
                    </button>
                `;
            });

            document.getElementById("usersList").innerHTML = html;
        });
}

// =========================
// OPEN PRIVATE CHAT
// =========================
function openChat(userId, username) {
    const formData = new FormData();
    formData.append("user_id", userId);

    fetch("api/get_or_create_private_chat.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        currentChatId = data.chat_id;
        lastMessagesJson = "";

        document.getElementById("chatTitle").innerText = "Chat me " + username;
        document.getElementById("messages").innerHTML = "";

        loadMessages();
    });
}

// =========================
// LOAD MESSAGES
// =========================
function loadMessages() {
    if (!currentChatId) return;

    fetch("api/get_messages.php?chat_id=" + currentChatId)
        .then(res => res.json())
        .then(messages => {

            let newJson = JSON.stringify(messages);

            // Nëse s’ka mesazhe të reja, mos e rindërto ekranin kot
            if (newJson === lastMessagesJson) return;

            lastMessagesJson = newJson;

            let html = "";

            if (messages.length === 0) {
                html = `
                    <div class="text-center text-gray-500 mt-20">
                        Nuk ka ende mesazhe. Shkruaj i/e pari/a.
                    </div>
                `;
            }

            messages.forEach(msg => {
                let own = Number(msg.sender_id) === Number(currentUserId);
                let time = msg.created_at.substring(11, 16);

                html += `
                    <div class="w-full flex ${own ? 'justify-end' : 'justify-start'} mb-4">
                        <div class="max-w-[65%]">

                            <p class="text-xs mb-1 ${own ? 'text-right text-teal-300' : 'text-left text-gray-400'}">
                                ${msg.username}
                            </p>

                            <div class="px-4 py-3 rounded-2xl shadow-lg break-words
                                ${own
                                    ? 'bg-teal-400 text-black rounded-br-none'
                                    : 'bg-slate-700 text-white rounded-bl-none'}">
                                ${msg.message}
                            </div>

                            <p class="text-[11px] mt-1 ${own ? 'text-right text-gray-400' : 'text-left text-gray-500'}">
                                ${time}
                            </p>

                        </div>
                    </div>
                `;
            });

            const box = document.getElementById("messages");
            box.innerHTML = html;
            box.scrollTop = box.scrollHeight;
        });
}

// =========================
// SEND MESSAGE
// =========================
document.getElementById("messageForm").addEventListener("submit", function(e) {
    e.preventDefault();

    if (!currentChatId) {
        alert("Zgjidh një përdorues fillimisht.");
        return;
    }

    let input = document.getElementById("messageInput");
    let message = input.value.trim();

    if (message === "") return;

    const formData = new FormData();
    formData.append("chat_id", currentChatId);
    formData.append("message", message);

    fetch("api/send_message.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            input.value = "";
            loadMessages();
        } else {
            alert("Mesazhi nuk u dërgua.");
        }
    });
});

// =========================
// AUTO REFRESH WITHOUT PAGE RELOAD
// =========================
setInterval(loadMessages, 2000);

loadUsers();
</script>

</body>
</html>
