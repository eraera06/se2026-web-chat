<!DOCTYPE html>
<html lang="sq">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   WebChat — Bisedo në kohë reale
  </title>
  <link href="https://fonts.googleapis.com" rel="preconnect"/>
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800;900&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
   
:root{
  --neon:#00e5c8;
  --neon2:#00b8a3;
  --neon-dim:rgba(0,229,200,.12);
  --dark:#070c14;
  --dark2:#0d1421;
  --dark3:#121c2e;
  --panel:rgba(255,255,255,.04);
  --panel2:rgba(255,255,255,.07);
  --border:rgba(255,255,255,.09);
  --border2:rgba(0,229,200,.25);
  --text:#e8f0fe;
  --muted:#6b7fa3;
  --danger:#ff4d6d;
  --success:#00e5a0;
  --gold:#fbbf24;
  --radius:18px;
  --radius-sm:12px;
  --font:"Sora",sans-serif;
  --mono:"JetBrains Mono",monospace;
  --shadow:0 32px 80px rgba(0,0,0,.55);
  --glow:0 0 30px rgba(0,229,200,.18)
}

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:var(--font)
}

html,body{
  height:100%;
  overflow:hidden
}

body{
  background:var(--dark);
  zzcolor:var(--text);
  background-image:radial-gradient(ellipse 60% 40% at 15% 10%,rgba(0,229,200,.06) 0%,transparent 60%),radial-gradient(ellipse 50% 60% at 85% 90%,rgba(0,100,255,.06) 0%,transparent 60%),url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.015'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")
}

.hidden{
  display:none!important
}

button{
  border:none;
  cursor:pointer;
  font-family:var(--font)
}

input,textarea{
  outline:none;
  font-family:var(--font)
}

::-webkit-scrollbar{
  width:4px
}

::-webkit-scrollbar-track{
  background:transparent
}

::-webkit-scrollbar-thumb{
  background:var(--border2);
  border-radius:4px
}

body::before{
  content:"";
  position:fixed;
  inset:0;
  pointer-events:none;
  z-index:0;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
  opacity:.4
}

.auth-page{
  position:fixed;
  inset:0;
  display:flex;
  align-items:center;
  justify-content:center;
  z-index:10;
  padding:20px
}

.auth-box{
  width:900px;
  max-width:100%;
  display:grid;
  grid-template-columns:1fr 1fr;
  border-radius:28px;
  overflow:hidden;
  background:var(--dark2);
  border:1px solid var(--border);
  box-shadow:var(--shadow),var(--glow);
  position:relative;
  animation:slideUp .5s cubic-bezier(.16,1,.3,1) both
}

@keyframes slideUp{
  from{
    opacity:0;
    transform:translateY(30px)
  }

  to{
    opacity:1;
    transform:none
  }

}

.auth-left{
  background:linear-gradient(145deg,#0a1628,#061018);
  padding:56px 44px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  position:relative;
  overflow:hidden;
  border-right:1px solid var(--border)
}

.auth-left::before{
  content:"";
  position:absolute;
  width:300px;
  height:300px;
  border-radius:50%;
  background:radial-gradient(circle,rgba(0,229,200,.15),transparent 70%);
  top:-80px;
  left:-80px
}

.auth-left::after{
  content:"";
  position:absolute;
  width:200px;
  height:200px;
  border-radius:50%;
  background:radial-gradient(circle,rgba(0,100,255,.12),transparent 70%);
  bottom:-50px;
  right:-50px
}

.logo-wrap{
  text-align:center;
  position:relative;
  z-index:2
}

.logo-icon{
  width:100px;
  height:100px;
  border-radius:28px;
  background:linear-gradient(135deg,var(--neon),#00a8f3);
  display:grid;
  place-items:center;
  font-size:44px;
  margin:0 auto 22px;
  box-shadow:0 20px 50px rgba(0,229,200,.3),0 0 0 1px rgba(0,229,200,.25);
  animation:pulse 3s ease-in-out infinite
}

@keyframes pulse{
  0%,100%{
    box-shadow:0 20px 50px rgba(0,229,200,.3),0 0 0 1px rgba(0,229,200,.25)
  }

  50%{
    box-shadow:0 20px 50px rgba(0,229,200,.5),0 0 0 1px rgba(0,229,200,.5)
  }

}

.logo-wrap h1{
  font-size:42px;
  font-weight:900;
  color:white;
  letter-spacing:-.5px
}

.logo-wrap p{
  color:var(--muted);
  margin-top:8px;
  font-size:14px;
  font-weight:400
}

.features{
  margin-top:40px;
  display:flex;
  flex-direction:column;
  gap:14px;
  width:100%;
  z-index:2;
  position:relative
}

.feat{
  display:flex;
  align-items:center;
  gap:12px;
  color:var(--muted);
  font-size:13px
}

.feat-icon{
  width:32px;
  height:32px;
  border-radius:10px;
  background:var(--neon-dim);
  border:1px solid var(--border2);
  display:grid;
  place-items:center;
  font-size:14px;
  flex-shrink:0
}

.auth-right{
  padding:50px 44px;
  display:flex;
  align-items:center
}

.form-area{
  width:100%
}

.tabs{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:6px;
  background:rgba(255,255,255,.04);
  padding:6px;
  border-radius:16px;
  margin-bottom:30px;
  border:1px solid var(--border)
}

.tab{
  padding:12px;
  border-radius:12px;
  font-weight:700;
  font-size:14px;
  background:transparent;
  color:var(--muted);
  transition:.2s
}

.tab.active{
  background:linear-gradient(135deg,var(--neon),var(--neon2));
  color:#000;
  box-shadow:0 8px 20px rgba(0,229,200,.3)
}

.form-title{
  font-size:28px;
  font-weight:900;
  color:white;
  margin-bottom:4px
}

.form-text{
  color:var(--muted);
  margin-bottom:22px;
  font-size:14px
}

.alert{
  display:none;
  padding:12px 14px;
  border-radius:12px;
  margin-bottom:14px;
  font-size:13px;
  font-weight:600
}

.alert.show{
  display:block
}

.alert.error{
  background:rgba(255,77,109,.12);
  color:var(--danger);
  border:1px solid rgba(255,77,109,.25)
}

.alert.success{
  background:rgba(0,229,160,.1);
  color:var(--success);
  border:1px solid rgba(0,229,160,.25)
}

.input-group{
  margin-bottom:14px
}

.input-group label{
  display:block;
  font-size:12px;
  font-weight:700;
  color:var(--muted);
  margin-bottom:7px;
  letter-spacing:.05em;
  text-transform:uppercase
}

.input-group input{
  width:100%;
  padding:13px 15px;
  border-radius:13px;
  border:1px solid var(--border);
  background:var(--panel);
  color:var(--text);
  font-size:14px;
  transition:.2s
}

.input-group input:focus{
  border-color:var(--neon2);
  background:rgba(0,229,200,.05);
  box-shadow:0 0 0 3px rgba(0,229,200,.1)
}

.input-group input::placeholder{
  color:var(--muted)
}

.submit-btn{
  width:100%;
  padding:14px;
  border-radius:14px;
  background:linear-gradient(135deg,var(--neon),var(--neon2));
  color:#050d19;
  font-weight:900;
  font-size:15px;
  margin-top:6px;
  transition:.2s;
  letter-spacing:.02em
}

.submit-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 16px 35px rgba(0,229,200,.35)
}

.submit-btn:active{
  transform:translateY(0)
}

.submit-btn:disabled{
  opacity:.6;
  cursor:not-allowed;
  transform:none
}

.form-link{
  text-align:center;
  margin-top:16px;
  color:var(--muted);
  font-size:13px
}

.form-link span{
  color:var(--neon);
  font-weight:700;
  cursor:pointer;
  transition:.15s
}

.form-link span:hover{
  text-shadow:0 0 12px var(--neon)
}

.chat-page{
  position:fixed;
  inset:0;
  display:flex;
  flex-direction:column;
  z-index:5;
  background:var(--dark)
}

.topbar{
  height:64px;
  background:rgba(13,20,33,.9);
  border-bottom:1px solid var(--border);
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:0 22px;
  backdrop-filter:blur(20px);
  flex-shrink:0;
  z-index:20
}

.topbar-left{
  display:flex;
  align-items:center;
  gap:11px
}

.topbar-logo{
  width:38px;
  height:38px;
  border-radius:12px;
  background:linear-gradient(135deg,var(--neon),#00a8f3);
  display:grid;
  place-items:center;
  font-size:18px;
  box-shadow:0 4px 15px rgba(0,229,200,.3)
}

.topbar-name{
  font-size:18px;
  font-weight:900;
  color:white
}

.topbar-right{
  display:flex;
  align-items:center;
  gap:10px
}

.user-pill{
  display:flex;
  align-items:center;
  gap:9px;
  background:var(--panel);
  border:1px solid var(--border);
  border-radius:999px;
  padding:6px 14px 6px 6px
}

.user-pill .ava{
  width:28px;
  height:28px;
  border-radius:50%;
  background:linear-gradient(135deg,var(--neon),#4f46e5);
  display:grid;
  place-items:center;
  font-size:12px;
  font-weight:900;
  color:#050d19
}

.user-pill span{
  font-size:13px;
  font-weight:600;
  color:var(--text)
}

.icon-btn{
  width:38px;
  height:38px;
  border-radius:12px;
  background:var(--panel);
  border:1px solid var(--border);
  display:grid;
  place-items:center;
  font-size:17px;
  cursor:pointer;
  transition:.2s;
  color:var(--muted)
}

.icon-btn:hover{
  background:var(--panel2);
  color:var(--text);
  border-color:var(--border2)
}

.logout-btn{
  padding:8px 16px;
  border-radius:12px;
  background:rgba(255,77,109,.1);
  border:1px solid rgba(255,77,109,.2);
  color:var(--danger);
  font-weight:700;
  font-size:13px;
  transition:.2s
}

.logout-btn:hover{
  background:rgba(255,77,109,.2)
}

.chat-layout{
  flex:1;
  min-height:0;
  display:grid;
  grid-template-columns:310px 1fr;
  gap:0
}

.sidebar{
  background:var(--dark2);
  border-right:1px solid var(--border);
  display:flex;
  flex-direction:column;
  overflow:hidden
}

.sidebar-header{
  padding:18px;
  border-bottom:1px solid var(--border)
}

.sidebar-search{
  width:100%;
  padding:11px 14px;
  border-radius:13px;
  border:1px solid var(--border);
  background:var(--panel);
  color:var(--text);
  font-size:13px;
  transition:.2s
}

.sidebar-search:focus{
  border-color:var(--neon2);
  background:rgba(0,229,200,.05)
}

.sidebar-search::placeholder{
  color:var(--muted)
}

.side-tabs{
  display:flex;
  gap:4px;
  padding:14px 18px 0
}

.side-tab{
  flex:1;
  padding:9px;
  border-radius:11px;
  font-size:12px;
  font-weight:700;
  text-transform:uppercase;
  letter-spacing:.05em;
  background:transparent;
  color:var(--muted);
  border:none;
  cursor:pointer;
  transition:.2s
}

.side-tab.active{
  background:var(--neon-dim);
  color:var(--neon);
  border:1px solid var(--border2)
}

.side-content{
  flex:1;
  overflow-y:auto;
  padding:14px
}

.side-section-title{
  font-size:11px;
  font-weight:800;
  color:var(--muted);
  text-transform:uppercase;
  letter-spacing:.08em;
  margin:10px 0 10px
}

.user-card,.chat-card{
  display:flex;
  align-items:center;
  gap:11px;
  padding:11px 13px;
  border-radius:14px;
  cursor:pointer;
  transition:.2s;
  margin-bottom:4px;
  border:1px solid transparent;
  position:relative
}

.user-card:hover,.chat-card:hover{
  background:var(--panel);
  border-color:var(--border)
}

.chat-card.active{
  background:var(--neon-dim);
  border-color:var(--border2);
  box-shadow:0 4px 20px rgba(0,229,200,.08)
}

.ava{
  width:40px;
  height:40px;
  border-radius:50%;
  background:linear-gradient(135deg,var(--neon),#4f46e5);
  display:grid;
  place-items:center;
  font-weight:900;
  font-size:15px;
  color:#050d19;
  flex-shrink:0
}

.ava-sm{
  width:32px;
  height:32px;
  font-size:12px
}

.item-info{
  min-width:0;
  flex:1
}

.item-info strong{
  display:block;
  font-size:13px;
  font-weight:700;
  color:var(--text);
  white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis
}

.item-sub{
  color:var(--muted);
  font-size:12px;
  margin-top:2px;
  white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis
}

.dot-online{
  width:9px;
  height:9px;
  border-radius:50%;
  background:var(--success);
  flex-shrink:0;
  box-shadow:0 0 8px var(--success)
}

.badge{
  font-size:10px;
  font-weight:900;
  color:#050d19;
  background:var(--neon);
  padding:3px 8px;
  border-radius:999px;
  white-space:nowrap
}

.badge-gold{
  background:var(--gold);
  color:#050d19
}

.empty-mini{
  padding:20px;
  text-align:center;
  color:var(--muted);
  font-size:13px;
  border:1px dashed var(--border);
  border-radius:14px;
  margin-top:6px
}

.chat-main{
  min-width:0;
  min-height:0;
  display:flex;
  flex-direction:column;
  background:var(--dark3);
  position:relative
}

.chat-header{
  height:70px;
  flex-shrink:0;
  background:rgba(13,20,33,.85);
  border-bottom:1px solid var(--border);
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:0 22px;
  gap:14px;
  backdrop-filter:blur(20px);
  z-index:10
}

.chat-title-info strong{
  font-size:16px;
  font-weight:800;
  color:white;
  display:block
}

.chat-subtitle{
  color:var(--muted);
  font-size:12px;
  margin-top:2px;
  display:flex;
  align-items:center;
  gap:6px
}

.status-dot{
  width:7px;
  height:7px;
  border-radius:50%;
  background:var(--success);
  box-shadow:0 0 6px var(--success);
  animation:blink 2s ease-in-out infinite
}

@keyframes blink{
  0%,100%{
    opacity:1
  }

  50%{
    opacity:.4
  }

}

.header-actions{
  display:flex;
  gap:8px;
  align-items:center
}

.msg-search{
  padding:9px 14px;
  border-radius:11px;
  border:1px solid var(--border);
  background:var(--panel);
  color:var(--text);
  font-size:13px;
  width:200px;
  transition:.2s
}

.msg-search:focus{
  border-color:var(--neon2);
  width:240px
}

.msg-search::placeholder{
  color:var(--muted)
}

.messages{
  flex:1;
  overflow-y:auto;
  padding:22px;
  display:flex;
  flex-direction:column;
  gap:10px
}

.empty-state{
  margin:auto;
  text-align:center;
  color:var(--muted)
}

.empty-state .empty-icon{
  font-size:50px;
  margin-bottom:14px
}

.empty-state p{
  font-size:15px;
  max-width:260px;
  line-height:1.6
}

.msg-wrap{
  display:flex;
  flex-direction:column;
  gap:2px;
  max-width:72%
}

.msg-wrap.me{
  align-self:flex-end;
  align-items:flex-end
}

.msg-wrap.them{
  align-self:flex-start;
  align-items:flex-start
}

.msg-sender{
  font-size:11px;
  font-weight:700;
  color:var(--muted);
  margin-bottom:3px;
  padding:0 4px
}

.message{
  padding:12px 16px;
  border-radius:18px;
  font-size:14px;
  line-height:1.55;
  word-break:break-word;
  position:relative
}

.me .message{
  background:linear-gradient(135deg,var(--neon),var(--neon2));
  color:#050d19;
  border-bottom-right-radius:5px;
  box-shadow:0 8px 25px rgba(0,229,200,.2)
}

.them .message{
  background:var(--panel2);
  color:var(--text);
  border:1px solid var(--border);
  border-bottom-left-radius:5px
}

.msg-time{
  font-size:11px;
  color:var(--muted);
  padding:0 4px;
  margin-top:4px
}

.file-msg{
  display:flex;
  align-items:center;
  gap:10px;
  padding:10px 14px;
  border-radius:14px;
  background:rgba(0,229,200,.08);
  border:1px solid var(--border2);
  font-size:13px;
  cursor:pointer;
  transition:.2s
}

.file-msg:hover{
  background:rgba(0,229,200,.15)
}

.file-icon{
  font-size:22px
}

.file-name{
  font-weight:700;
  color:var(--neon)
}

.file-size{
  color:var(--muted);
  font-size:11px;
  margin-top:2px
}

.sys-msg{
  align-self:center;
  padding:6px 14px;
  border-radius:999px;
  font-size:12px;
  color:var(--muted);
  background:var(--panel);
  border:1px solid var(--border)
}

.chat-form{
  flex-shrink:0;
  background:rgba(13,20,33,.9);
  border-top:1px solid var(--border);
  padding:14px 18px;
  backdrop-filter:blur(20px)
}

.form-inner{
  display:flex;
  align-items:flex-end;
  gap:10px
}

.form-actions-left{
  display:flex;
  gap:6px
}

.file-btn,.emoji-btn{
  width:40px;
  height:40px;
  border-radius:12px;
  background:var(--panel);
  border:1px solid var(--border);
  display:grid;
  place-items:center;
  font-size:18px;
  cursor:pointer;
  transition:.2s;
  flex-shrink:0;
  color:var(--muted)
}

.file-btn:hover,.emoji-btn:hover{
  background:var(--panel2);
  border-color:var(--border2);
  color:var(--neon)
}

.msg-input{
  flex:1;
  padding:12px 15px;
  border-radius:14px;
  border:1px solid var(--border);
  background:var(--panel);
  color:var(--text);
  font-size:14px;
  transition:.2s;
  resize:none;
  max-height:120px;
  min-height:44px;
  line-height:1.4
}

.msg-input:focus{
  border-color:var(--neon2);
  background:rgba(0,229,200,.04)
}

.msg-input::placeholder{
  color:var(--muted)
}

.send-btn{
  width:44px;
  height:44px;
  border-radius:14px;
  flex-shrink:0;
  background:linear-gradient(135deg,var(--neon),var(--neon2));
  display:grid;
  place-items:center;
  font-size:18px;
  transition:.2s;
  color:#050d19
}

.send-btn:hover{
  transform:scale(1.05);
  box-shadow:0 8px 20px rgba(0,229,200,.35)
}

.send-btn:active{
  transform:scale(.97)
}

.file-preview{
  display:none;
  align-items:center;
  gap:10px;
  background:rgba(0,229,200,.07);
  border:1px solid var(--border2);
  border-radius:12px;
  padding:10px 14px;
  margin-bottom:10px;
  font-size:13px
}

.file-preview.show{
  display:flex
}

.file-preview .remove{
  cursor:pointer;
  color:var(--danger);
  font-size:16px;
  margin-left:auto
}

.donate-panel{
  display:none;
  flex-direction:column;
  background:rgba(13,20,33,.98);
  border-top:1px solid var(--border);
  padding:20px 22px;
  gap:14px;
  animation:slideDown .3s ease both
}

#paypalCheckoutBtn:hover{
  transform:translateY(-2px);
  box-shadow:0 14px 35px rgba(255,196,57,.35)
}

#paypalModal .modal{
  background:linear-gradient(145deg,#0d1421,#09111c)
}

.amount-btn:hover,.amount-btn.selected{
  background:rgba(251,191,36,.12);
  border-color:var(--gold);
  color:var(--gold)
}

.amount-btn.selected{
  box-shadow:0 4px 15px rgba(251,191,36,.2)
}

.paypal-btn{
  padding:13px 28px;
  border-radius:14px;
  background:linear-gradient(135deg,#0070f3,#0060d3);
  color:white;
  font-weight:900;
  font-size:14px;
  border:none;
  cursor:pointer;
  transition:.2s;
  display:flex;
  align-items:center;
  gap:10px;
  align-self:flex-start
}

.paypal-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 12px 30px rgba(0,112,243,.4)
}

.paypal-logo{
  font-size:18px;
  font-weight:900;
  font-style:italic;
  color:#00c6ff
}

.typing{
  display:none;
  align-self:flex-start;
  padding:10px 16px;
  border-radius:18px;
  border-bottom-left-radius:5px;
  background:var(--panel2);
  border:1px solid var(--border)
}

.typing.show{
  display:block
}

.typing-dots{
  display:flex;
  gap:4px;
  align-items:center;
  height:16px
}

.typing-dots span{
  width:6px;
  height:6px;
  border-radius:50%;
  background:var(--muted);
  animation:dot .8s ease-in-out infinite
}

.typing-dots span:nth-child(2){
  animation-delay:.15s
}

.typing-dots span:nth-child(3){
  animation-delay:.3s
}

@keyframes dot{
  0%,80%,100%{
    transform:scale(.8);
    opacity:.4
  }

  40%{
    transform:scale(1);
    opacity:1
  }

}

.modal-overlay{
  display:none;
  position:fixed;
  inset:0;
  background:rgba(0,0,0,.7);
  backdrop-filter:blur(6px);
  z-index:100;
  align-items:center;
  justify-content:center
}

.modal-overlay.show{
  display:flex
}

.modal{
  background:var(--dark2);
  border:1px solid var(--border);
  border-radius:24px;
  padding:32px;
  width:440px;
  max-width:95%;
  box-shadow:var(--shadow);
  animation:slideUp .3s cubic-bezier(.16,1,.3,1) both
}

.modal h3{
  font-size:20px;
  font-weight:900;
  color:white;
  margin-bottom:6px
}

.modal p{
  color:var(--muted);
  font-size:14px;
  margin-bottom:24px
}

.modal-actions{
  display:flex;
  gap:10px;
  justify-content:flex-end
}

.btn-cancel{
  padding:11px 20px;
  border-radius:12px;
  background:var(--panel);
  border:1px solid var(--border);
  color:var(--muted);
  font-weight:700;
  cursor:pointer;
  transition:.2s
}

.btn-cancel:hover{
  background:var(--panel2);
  color:var(--text)
}

.btn-danger{
  padding:11px 20px;
  border-radius:12px;
  background:rgba(255,77,109,.15);
  border:1px solid rgba(255,77,109,.3);
  color:var(--danger);
  font-weight:700;
  cursor:pointer;
  transition:.2s
}

.btn-danger:hover{
  background:rgba(255,77,109,.25)
}

.emoji-panel{
  display:none;
  position:absolute;
  left:18px;
  bottom:76px;
  width:292px;
  max-width:calc(100vw - 36px);
  background:rgba(13,20,33,.98);
  border:1px solid var(--border);
  border-radius:16px;
  padding:12px;
  box-shadow:var(--shadow);
  z-index:40;
  grid-template-columns:repeat(8,1fr);
  gap:6px
}

.emoji-panel.show{
  display:grid
}

.emoji-option{
  width:30px;
  height:30px;
  border-radius:9px;
  background:var(--panel);
  border:1px solid var(--border);
  font-size:18px;
  display:grid;
  place-items:center;
  transition:.2s
}

.emoji-option:hover{
  background:var(--neon-dim);
  border-color:var(--border2);
  transform:translateY(-1px)
}

.group-member-list{
  max-height:220px;
  overflow-y:auto;
  display:flex;
  flex-direction:column;
  gap:6px;
  margin-bottom:14px
}

.group-member{
  display:flex;
  align-items:center;
  gap:10px;
  padding:10px 12px;
  border-radius:13px;
  border:1px solid var(--border);
  background:var(--panel);
  cursor:pointer
}

.group-member:hover{
  background:var(--panel2);
  border-color:var(--border2)
}

.group-member input{
  accent-color:var(--neon)
}

.group-create-btn{
  padding:11px 20px;
  border-radius:12px;
  background:linear-gradient(135deg,var(--neon),var(--neon2));
  color:#050d19;
  font-weight:900
}

@media(max-width:768px){
  .auth-box{
    grid-template-columns:1fr
  }

  .auth-left{
    display:none
  }

  .auth-right{
    padding:30px 24px
  }

  .chat-layout{
    grid-template-columns:1fr
  }

  .sidebar{
    display:none
  }

  .msg-search{
    width:150px
  }

}

  </style>
 </head>
 <body>
  <section class="auth-page" id="authPage">
   <div class="auth-box">
    <div class="auth-left">
     <div class="logo-wrap">
      <div class="logo-icon">
       💬
      </div>
      <h1>
       WebChat
      </h1>
     </div>
     <div class="features">
     </div>
    </div>
    <div class="auth-right">
     <div class="form-area">
      <div class="tabs">
       <button class="tab active" id="loginTab" onclick="showLogin()">
        Hyr
       </button>
       <button class="tab" id="registerTab" onclick="showRegister()">
        Regjistrohu
       </button>
      </div>
      <div id="loginBox">
       <h2 class="form-title">
        Mirë se erdhe
       </h2>
       <p class="form-text">
        Hyr në llogarinë tënde për të vazhduar
       </p>
       <div class="alert error" id="loginAlert">
       </div>
       <form id="loginForm">
        <div class="input-group">
         <label>
          Email
         </label>
         <input name="email" placeholder="email@shembull.com" required="" type="email"/>
        </div>
        <div class="input-group">
         <label>
          Password
         </label>
         <input name="password" placeholder="Shkruaj password-in" required="" type="password"/>
        </div>
        <button class="submit-btn" id="loginBtn" type="submit">
         Hyr në Chat →
        </button>
       </form>
       <div class="form-link">
        Nuk ke llogari?
        <span onclick="showRegister()">
         Regjistrohu falas
        </span>
       </div>
      </div>
      <div class="hidden" id="registerBox">
       <h2 class="form-title">
        Krijo llogari 
       </h2>
       <p class="form-text">
        Regjistrohu dhe fillo bisedat menjëherë
       </p>
       <div class="alert error" id="registerAlert">
       </div>
       <form id="registerForm">
        <div class="input-group">
         <label>
          Emri
         </label>
         <input name="name" placeholder="Emri yt" required="" type="text"/>
        </div>
        <div class="input-group">
         <label>
          Email
         </label>
         <input name="email" placeholder="email@shembull.com" required="" type="email"/>
        </div>
        <div class="input-group">
         <label>
          Password
         </label>
         <input minlength="6" name="password" placeholder="Minimumi 6 karaktere" required="" type="password"/>
        </div>
        <button class="submit-btn" id="registerBtn" type="submit">
         Krijo Llogarinë →
        </button>
       </form>
       <div class="form-link">
        Ke llogari?
        <span onclick="showLogin()">
         Hyr këtu
        </span>
       </div>
      </div>
     </div>
    </div>
   </div>
  </section>
  <section class="chat-page hidden" id="chatPage">
   <div class="topbar">
    <div class="topbar-left">
     <div class="topbar-logo">
      💬
     </div>
     <span class="topbar-name">
      WebChat
     </span>
    </div>
    <div class="topbar-right">
     <div class="user-pill">
      <div class="ava" id="topAva">
       ?
      </div>
      <span id="topName">
       Përdoruesi
      </span>
     </div>
     <button class="logout-btn" onclick="confirmLogout()">
      🚪 Logout
     </button>
    </div>
   </div>
   <div class="chat-layout">
    <aside class="sidebar">
     <div class="sidebar-header">
      <input class="sidebar-search" id="searchUser" placeholder="🔍  Kërko përdorues..."/>
     </div>
     <div class="side-tabs">
      <button class="side-tab active" onclick="switchSideTab('users',this)">
       👥 Përd.
      </button>
      <button class="side-tab" onclick="switchSideTab('chats',this)">
       💬 Biseda
      </button>
     </div>
     <div class="side-content">
      <div id="usersTab">
       <div class="side-section-title">
        Të gjithë përdoruesit
       </div>
       <div id="usersList">
       </div>
      </div>
      <div class="hidden" id="chatsTab">
       <div class="side-section-title">
        Bisedat e tua
       </div>
       <div id="chatsList">
       </div>
      </div>
     </div>
    </aside>
    <main class="chat-main">
     <div class="chat-header">
      <div style="display:flex;align-items:center;gap:13px;min-width:0">
       <div class="ava" id="activeAvatar">
        ?
       </div>
       <div class="chat-title-info">
        <strong id="activeChatName">
         Zgjidh një bisedë
        </strong>
        <div class="chat-subtitle">
         <span class="status-dot">
         </span>
         <span>
          Online
         </span>
        </div>
       </div>
      </div>
      <div class="header-actions">
       <input class="msg-search" id="messageSearch" placeholder="🔍 Kërko mesazh..."/>
       <button class="icon-btn" onclick="openGroupModal()" title="Krijo group chat">
        👥
       </button>
       <button class="icon-btn" onclick="openPaypalModal()" title="PayPal Checkout">
        💳
       </button>
      </div>
     </div>
     <div class="modal-overlay" id="paypalModal">
      <div class="modal" style="max-width:520px">
       <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
        <div>
         <h3 style="margin:0;font-size:26px">
          PayPal Checkout
         </h3>
         <p style="margin-top:6px;color:var(--muted)">
          Complete your secure payment
         </p>
        </div>
        <div style="background:#0070ba;color:white;padding:10px 16px;border-radius:14px;font-weight:900;font-style:italic;font-size:20px;letter-spacing:.02em;box-shadow:0 10px 30px rgba(0,112,186,.35)">
         PayPal
        </div>
       </div>
       <div style="background:rgba(255,255,255,.03);border:1px solid var(--border);border-radius:20px;padding:20px;margin-bottom:18px">
        <div style="display:flex;justify-content:space-between;margin-bottom:14px">
         <span style="color:var(--muted)">
          Product
         </span>
         <strong>
          WebChat Premium
         </strong>
        </div>
        <div style="display:flex;justify-content:space-between;margin-bottom:14px">
         <span style="color:var(--muted)">
          License
         </span>
         <strong>
          Lifetime Access
         </strong>
        </div>
        <div style="display:flex;justify-content:space-between;margin-bottom:14px">
         <span style="color:var(--muted)">
          Security
         </span>
         <strong style="color:var(--success)">
          SSL Secured
         </strong>
        </div>
        <div style="display:flex;justify-content:space-between;margin-bottom:14px">
         <span style="color:var(--muted)">
          Tax
         </span>
         <strong>
          $0.00
         </strong>
        </div>
        <div style="height:1px;background:var(--border);margin:18px 0">
        </div>
        <div style="display:flex;justify-content:space-between;align-items:center">
         <span style="font-size:17px;font-weight:800">
          Total
         </span>
         <span style="font-size:30px;font-weight:900;color:var(--neon);text-shadow:0 0 20px rgba(0,229,200,.35)">
          $49.99
         </span>
        </div>
       </div>
       <div style="display:flex;flex-direction:column;gap:12px">
        <button id="paypalCheckoutBtn" onclick="fakePaypalCheckout(event)" style="width:100%;border:none;padding:16px;border-radius:16px;background:#ffc439;color:#111;font-weight:900;font-size:17px;cursor:pointer;transition:.2s">
         Checkout with PayPal
        </button>
        <button class="btn-cancel" onclick="closePaypalModal()">
         Cancel
        </button>
       </div>
       <div style="margin-top:18px;text-align:center;color:var(--muted);font-size:12px">
        🔒 Payments are encrypted and securely processed by PayPal
       </div>
      </div>
     </div>
     <div class="messages" id="messagesBox">
      <div class="empty-state">
       <div class="empty-icon">
        💬
       </div>
       <p>
        Zgjidh një përdorues ose bisedë për të filluar chatting.
       </p>
      </div>
     </div>
     <div class="typing" id="typingIndicator">
      <div class="typing-dots">
       <span>
       </span>
       <span>
       </span>
       <span>
       </span>
      </div>
     </div>
     <div class="file-preview" id="filePreview">
      <span id="filePreviewName">
       file.pdf
      </span>
      <span id="filePreviewSize" style="color:var(--muted);font-size:12px;margin-left:6px">
      </span>
      <span class="remove" onclick="clearFile()">
       ✕
      </span>
     </div>
     <div class="emoji-panel" id="emojiPanel">
     </div>
     <form class="chat-form" id="messageForm">
      <div class="form-inner">
       <div class="form-actions-left">
        <label class="file-btn" title="Ngarko skedar">
         📎
         <input id="fileInput" onchange="previewFile(this)" style="display:none" type="file"/>
        </label>
        <button class="emoji-btn" onclick="toggleEmojiPanel()" title="Emoji" type="button">
         😊
        </button>
       </div>
       <textarea class="msg-input" id="messageInput" placeholder="Shkruaj mesazhin..." rows="1"></textarea>
       <button class="send-btn" type="submit">
        ➤
       </button>
      </div>
     </form>
    </main>
   </div>
  </section>
  <div class="modal-overlay" id="groupModal">
   <div class="modal">
    <h3>
     👥 Krijo Group Chat
    </h3>
    <p>
     Zgjidh emrin e grupit dhe anëtarët.
    </p>
    <form id="groupForm">
     <div class="input-group">
      <label>
       Emri i grupit
      </label>
      <input id="groupName" placeholder="P.sh. Klasa 12A" required="" type="text"/>
     </div>
     <div class="side-section-title">
      Anëtarët
     </div>
     <div class="group-member-list" id="groupMembersList">
      <div class="empty-mini">
       Duke ngarkuar përdoruesit...
      </div>
     </div>
     <div class="alert error" id="groupAlert">
     </div>
     <div class="modal-actions">
      <button class="btn-cancel" onclick="closeGroupModal()" type="button">
       Anulo
      </button>
      <button class="group-create-btn" type="submit">
       Krijo Grupin
      </button>
     </div>
    </form>
   </div>
  </div>
  <div class="modal-overlay" id="logoutModal">
   <div class="modal">
    <h3>
     Konfirmo Logout
    </h3>
    <p>
     A jeni i sigurt që doni të dilni nga llogaria?
    </p>
    <div class="modal-actions">
     <button class="btn-cancel" onclick="closeModal()">
      Anulo
     </button>
     <button class="btn-danger" onclick="doLogout()">
      Po, dil
     </button>
    </div>
   </div>
  </div>
  <script>
   
const authPage=document.getElementById("authPage");
const chatPage=document.getElementById("chatPage");
const loginBox=document.getElementById("loginBox");
const registerBox=document.getElementById("registerBox");
const loginTab=document.getElementById("loginTab");
const registerTab=document.getElementById("registerTab");
const loginForm=document.getElementById("loginForm");
const registerForm=document.getElementById("registerForm");
const loginBtn=document.getElementById("loginBtn");
const registerBtn=document.getElementById("registerBtn");
const loginAlert=document.getElementById("loginAlert");
const registerAlert=document.getElementById("registerAlert");
const topAva=document.getElementById("topAva");
const topName=document.getElementById("topName");
const usersList=document.getElementById("usersList");
const chatsList=document.getElementById("chatsList");
const searchUser=document.getElementById("searchUser");
const usersTab=document.getElementById("usersTab");
const chatsTab=document.getElementById("chatsTab");
const activeChatName=document.getElementById("activeChatName");
const activeAvatar=document.getElementById("activeAvatar");
const messagesBox=document.getElementById("messagesBox");
const messageForm=document.getElementById("messageForm");
const messageInput=document.getElementById("messageInput");
const messageSearch=document.getElementById("messageSearch");
const fileInput=document.getElementById("fileInput");
const filePreview=document.getElementById("filePreview");
const filePreviewName=document.getElementById("filePreviewName");
const filePreviewSize=document.getElementById("filePreviewSize");
const donatePanel=document.getElementById("donatePanel");
const logoutModal=document.getElementById("logoutModal");
const emojiPanel=document.getElementById("emojiPanel");
const groupModal=document.getElementById("groupModal");
const groupForm=document.getElementById("groupForm");
const groupName=document.getElementById("groupName");
const groupMembersList=document.getElementById("groupMembersList");
const groupAlert=document.getElementById("groupAlert");
let currentUserId=null,currentUserName="",activeChatId=null,lastMsgId=0,pollInterval=null,selectedAmount="1",selectedFile=null,currentSideTab="users";
function showLogin(){
  loginBox.classList.remove("hidden");
  registerBox.classList.add("hidden");
  loginTab.classList.add("active");
  registerTab.classList.remove("active")
}
function showRegister(){
  registerBox.classList.remove("hidden");
  loginBox.classList.add("hidden");
  registerTab.classList.add("active");
  loginTab.classList.remove("active")
}
function showAlert(el,msg,type="error"){
  el.textContent=msg;
  el.className="alert show "+type
}
async function checkSession(){
  try{
    const res=await fetch("api/check_session.php");
    const data=await res.json();
    if(data.status==="success"&&data.user_id){
      currentUserId=data.user_id;
      currentUserName=data.name||"Përdoruesi";
      enterChat()
    }
  }
  catch(e){
  }
}
loginForm.addEventListener("submit",async function(e){
  e.preventDefault();loginBtn.disabled=true;loginBtn.textContent="Duke hyrë...";showAlert(loginAlert,"","error");loginAlert.classList.remove("show");
  try{
    const res=await fetch("auth/login_process.php",{
      method:"POST",body:new FormData(this)
    }
    );
    if(!res.ok)throw new Error("HTTP "+res.status);
    const text=await res.text();let data;
    try{
      data=JSON.parse(text)
    }
    catch(parseErr){
      console.error("Resposta nuk është JSON:",text);showAlert(loginAlert,"Gabim serveri — kontrollo login_process.php");return
    }
    if(data.status==="success"){
      currentUserId=data.user_id;currentUserName=data.name||"Përdoruesi";enterChat()
    }
    else{
      showAlert(loginAlert,data.message||"Email ose password gabim")
    }
  }
  catch(err){
    console.error("Login error:",err);showAlert(loginAlert,"Gabim lidhjes — provoni sërisht")
  }
  finally{
    loginBtn.disabled=false;loginBtn.textContent="Hyr në Chat →"
  }
}
);
registerForm.addEventListener("submit",async function(e){
  e.preventDefault();registerBtn.disabled=true;registerBtn.textContent="Duke u regjistruar...";showAlert(registerAlert,"","error");registerAlert.classList.remove("show");
  try{
    const res=await fetch("auth/register_process.php",{
      method:"POST",body:new FormData(this)
    }
    );
    if(!res.ok)throw new Error("HTTP "+res.status);
    const text=await res.text();let data;
    try{
      data=JSON.parse(text)
    }
    catch(parseErr){
      console.error("Resposta nuk është JSON:",text);showAlert(registerAlert,"Gabim serveri — kontrollo register_process.php");return
    }
    if(data.status==="success"){
      showLogin();showAlert(loginAlert,"✅ Llogaria u krijua! Hyr tani.","success");registerForm.reset()
    }
    else{
      showAlert(registerAlert,data.message||"Gabim gjatë regjistrimit")
    }
  }
  catch(err){
    console.error("Register error:",err);showAlert(registerAlert,"Gabim lidhjes — provoni sërisht")
  }
  finally{
    registerBtn.disabled=false;registerBtn.textContent="Krijo Llogarinë →"
  }
}
);
function enterChat(){
  authPage.classList.add("hidden");
  chatPage.classList.remove("hidden");
  topAva.textContent=currentUserName.charAt(0).toUpperCase();
  topName.textContent=currentUserName;
  loadUsers();
  loadChats();
  startPolling()
}
function switchSideTab(tab,btn){
  currentSideTab=tab;
  document.querySelectorAll(".side-tab").forEach(b=>b.classList.remove("active"));
  btn.classList.add("active");
  usersTab.classList.toggle("hidden",tab!=="users");
  chatsTab.classList.toggle("hidden",tab!=="chats")
}
async function loadUsers(){
  try{
    const q=searchUser.value.trim();
    const res=await fetch("api/get_users.php?q="+encodeURIComponent(q));
    const users=await res.json();
    if(!users.length){
      usersList.innerHTML=`<div class="empty-mini">Asnjë përdorues gjetur.</div>`;
      return
    }
    usersList.innerHTML=users.map(u=>`
      <div class="user-card" onclick='openPrivateChat(${u.id}, ${jsString(u.name)})'>
        <div class="ava">${u.name.charAt(0).toUpperCase()}</div>
        <div class="item-info"><strong>${safeText(u.name)}</strong><div class="item-sub">${safeText(u.email)}</div></div>
        <div class="dot-online"></div>
      </div>`).join("");
  }
  catch(e){
    console.error("loadUsers error:",e)
  }
}
async function loadChats(){
  try{
    const res=await fetch("api/get_chats.php");
    const chats=await res.json();
    if(!chats.length){
      chatsList.innerHTML=`<div class="empty-mini">Asnjë bisedë ende.</div>`;
      return
    }
    chatsList.innerHTML=chats.map(chat=>{
      const title=(chat.name&&chat.name.trim()!=="")?chat.name:"Chat privat";
      return `<div class="chat-card ${chat.id==activeChatId?'active':''}" onclick='openChat(${chat.id}, ${jsString(title)})'>
        <div class="ava">${title.charAt(0).toUpperCase()}</div>
        <div class="item-info"><strong>${safeText(title)}</strong><div class="item-sub">${safeText(chat.last_message||"Asnjë mesazh")}</div></div>
        <span class="badge">${chat.type==="group"?"Group":"Privat"}</span>
      </div>`;
    }
    ).join("");
  }
  catch(e){
    console.error("loadChats error:",e)
  }
}
async function openPrivateChat(userId, name){
  try{
    const fd = new FormData();
    fd.append("user_id", userId);
    const res = await fetch("api/get_or_create_private_chat.php", {
      method: "POST",
      body: fd
    }
    );
    const text = await res.text();
    let data;
    try{
      data = JSON.parse(text);
    }
    catch(e){
      console.error("Nuk është JSON:", text);
      alert("Gabim serveri te get_or_create_private_chat.php");
      return;
    }
    if(data.status === "success" && data.chat_id){
      activeChatId = data.chat_id;
      lastMsgId = 0;
      activeChatName.textContent = name;
      activeAvatar.textContent = name.charAt(0).toUpperCase();
      messagesBox.innerHTML = "";
      await loadMessages();
      await loadChats();
      switchSideTab("chats", document.querySelectorAll(".side-tab")[1]);
    }
    else{
      alert(data.message || "Nuk u hap biseda");
    }
  }
  catch(e){
    console.error("openPrivateChat error:", e);
    alert("Gabim lidhjeje kur hape bisedën");
  }
}
function openChat(id,name){
  activeChatId=id;
  lastMsgId=0;
  activeChatName.textContent=name;
  activeAvatar.textContent=name.charAt(0).toUpperCase();
  messagesBox.innerHTML="";
  loadMessages();
  loadChats()
}
async function loadMessages(){
  if(!activeChatId)return;
  try{
    const search=messageSearch.value.toLowerCase();
    const res=await fetch(`api/get_messages.php?chat_id=${activeChatId}&last_id=${lastMsgId}`);
    const messages=await res.json();
    if(!messages.length&&lastMsgId===0){
      messagesBox.innerHTML=`<div class="empty-state"><div class="empty-icon">👋</div><p>Asnjë mesazh ende. Fillo bisedën!</p></div>`;
      return
    }
    const filtered=messages.filter(m=>(m.message||"").toLowerCase().includes(search));
    if(lastMsgId===0)messagesBox.innerHTML="";
    filtered.forEach(m=>{
      const isMe=m.sender_id==currentUserId;const wrap=document.createElement("div");wrap.className="msg-wrap "+(isMe?"me":"them");let inner="";
      if(m.file_name){
        inner=`<div class="file-msg" onclick="downloadFile('${safeAttr(m.file_name)}')"><span class="file-icon">📎</span><div><div class="file-name">${safeText(m.file_name)}</div><div class="file-size">Klikoni për ta shkarkuar</div></div></div>`
      }
      else{
        inner=`<div class="message">${safeText(m.message)}</div>`
      }
      wrap.innerHTML=`<div class="msg-sender">${safeText(m.name)}</div>${inner}<div class="msg-time">${safeText(m.created_at)}</div>`;
      messagesBox.appendChild(wrap);if(m.id>lastMsgId)lastMsgId=parseInt(m.id);
    }
    );
    if(filtered.length)messagesBox.scrollTop=messagesBox.scrollHeight;
  }
  catch(e){
    console.error("loadMessages error:",e)
  }
}
function startPolling(){
  if(pollInterval)clearInterval(pollInterval);
  pollInterval=setInterval(()=>{
    loadMessages();loadChats()
  }
  ,2000)
}
messageForm.addEventListener("submit",async function(e){
  e.preventDefault();
  if(!activeChatId){
    alert("Zgjidh një bisedë!");return
  }
  const text=messageInput.value.trim();
  if(!text&&!selectedFile)return;
  const fd=new FormData();fd.append("chat_id",activeChatId);fd.append("message",text||"");if(selectedFile)fd.append("file",selectedFile);
  messageInput.value="";messageInput.style.height="auto";clearFile();
  try{
    await fetch("api/send_message.php",{
      method:"POST",body:fd
    }
    );lastMsgId=0;await loadMessages()
  }
  catch(e){
    console.error("sendMessage error:",e)
  }
}
);
messageInput.addEventListener("input",function(){
  this.style.height="auto";this.style.height=Math.min(this.scrollHeight,120)+"px"
}
);
messageInput.addEventListener("keydown",function(e){
  if(e.key==="Enter"&&!e.shiftKey){
    e.preventDefault();messageForm.dispatchEvent(new Event("submit"))
  }
}
);
function previewFile(input){
  const file=input.files[0];
  if(!file)return;
  selectedFile=file;
  filePreviewName.textContent=file.name;
  filePreviewSize.textContent=formatBytes(file.size);
  filePreview.classList.add("show")
}
function clearFile(){
  selectedFile=null;
  fileInput.value="";
  filePreview.classList.remove("show")
}
function downloadFile(name){
  window.open("uploads/"+encodeURIComponent(name),"_blank")
}
function formatBytes(b){
  if(b<1024)return b+"B";
  if(b<1048576)return(b/1024).toFixed(1)+"KB";
  return(b/1048576).toFixed(1)+"MB"
}
function openPaypalModal(){
  document.getElementById("paypalModal").classList.add("show")
}
function closePaypalModal(){
  document.getElementById("paypalModal").classList.remove("show")
}
function fakePaypalCheckout(e){
  const btn=e.target;
  btn.disabled=true;
  btn.style.opacity=".8";
  btn.innerHTML="Processing Payment...";
  setTimeout(()=>{
    btn.innerHTML="Authorizing...";setTimeout(()=>{
      btn.innerHTML="Payment Successful ✓";btn.style.background="#00c16a";btn.style.color="white";
    setTimeout(()=>{
        window.open("https://www.paypal.com/","_blank");closePaypalModal();btn.disabled=false;btn.style.opacity="1";btn.style.background="#ffc439";btn.style.color="#111";btn.innerHTML="Checkout with PayPal"
      }
      ,1300);
    }
    ,1400)
  }
  ,1600);
}
const emojiList=["😀","😁","😂","🤣","😊","😍","😘","😎","😢","😭","😡","👍","👎","👏","🙏","💪","🔥","❤️","💙","💚","✨","🎉","💯","😅","🤔","🙌","👀","✅","❌","📌","📎","🚀"];
function renderEmojiPanel(){
  emojiPanel.innerHTML=emojiList.map(e=>`<button type="button" class="emoji-option" onclick="insertEmoji('${e}')">${e}</button>`).join("")
}
function toggleEmojiPanel(){
  emojiPanel.classList.toggle("show");
  messageInput.focus()
}
function insertEmoji(emoji){
  const start=messageInput.selectionStart||messageInput.value.length;
  const end=messageInput.selectionEnd||messageInput.value.length;
  messageInput.value=messageInput.value.slice(0,start)+emoji+messageInput.value.slice(end);
  messageInput.selectionStart=start+emoji.length;
  messageInput.selectionEnd=start+emoji.length;
  messageInput.focus();
  messageInput.dispatchEvent(new Event("input"));
}
document.addEventListener("click",function(e){
  if(!emojiPanel.contains(e.target)&&!e.target.closest(".emoji-btn"))emojiPanel.classList.remove("show")
}
);
async function openGroupModal(){
  groupModal.classList.add("show");
  groupAlert.classList.remove("show");
  await loadGroupMembers();
  groupName.focus()
}
function closeGroupModal(){
  groupModal.classList.remove("show");
  groupForm.reset();
  groupAlert.classList.remove("show")
}
async function loadGroupMembers(){
  try{
    const res=await fetch("api/get_users.php");
    const users=await res.json();
    const filteredUsers=users.filter(u=>String(u.id)!==String(currentUserId));
    if(!filteredUsers.length){
      groupMembersList.innerHTML=`<div class="empty-mini">Asnjë përdorues gjetur.</div>`;
      return
    }
    groupMembersList.innerHTML=filteredUsers.map(u=>`
      <label class="group-member">
        <input type="checkbox" name="members[]" value="${safeAttr(u.id)}">
        <div class="ava ava-sm">${safeText(u.name.charAt(0).toUpperCase())}</div>
        <div class="item-info"><strong>${safeText(u.name)}</strong><div class="item-sub">${safeText(u.email)}</div></div>
      </label>`).join("");
  }
  catch(e){
    console.error("loadGroupMembers error:",e);
    groupMembersList.innerHTML=`<div class="empty-mini">Gabim gjatë ngarkimit.</div>`
  }
}
groupForm.addEventListener("submit",async function(e){
  e.preventDefault();
  const name=groupName.value.trim();
  const members=[...groupForm.querySelectorAll('input[name="members[]"]:checked')].map(i=>i.value);
  if(!name){
    showAlert(groupAlert,"Shkruaj emrin e grupit.");return
  }
  if(members.length<2){
    showAlert(groupAlert,"Zgjidh të paktën 2 anëtarë për group chat.");return
  }
  const fd=new FormData();fd.append("name",name);members.forEach(id=>fd.append("members[]",id));
  try{
    const res=await fetch("api/create_chat.php",{
      method:"POST",body:fd
    }
    );
    const data=await res.json();
    if(data.status==="success"){
      closeGroupModal();openChat(data.chat_id,name);loadChats();switchSideTab("chats",document.querySelectorAll(".side-tab")[1])
    }
    else{
      showAlert(groupAlert,data.message||"Gabim gjatë krijimit të grupit.")
    }
  }
  catch(err){
    console.error("createGroup error:",err);showAlert(groupAlert,"Gabim lidhjes - kontrollo create_chat.php")
  }
}
);
searchUser.addEventListener("input",loadUsers);
messageSearch.addEventListener("input",()=>{
  lastMsgId=0;loadMessages()
}
);
function confirmLogout(){
  logoutModal.classList.add("show")
}
function closeModal(){
  logoutModal.classList.remove("show")
}
async function doLogout(){
  try{
    await fetch("logout.php")
  }
  catch(e){
  }
  location.reload()
}
function safeText(text){
  if(text==null)return"";
  const d=document.createElement("div");
  d.textContent=String(text);
  return d.innerHTML
}
function safeAttr(text){
  if(text==null)return"";
  return String(text).replace(/'/g,"&#39;").replace(/"/g,"&quot;")}
function jsString(text){return JSON.stringify(String(text??""))}

renderEmojiPanel();
checkSession();

  </script>
 </body>
</html>
