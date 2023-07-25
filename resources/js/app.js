import './bootstrap';
import '../scss/app.scss'

import { createApp } from 'vue';

import chat from './components/Chat.vue';

const app = createApp({});

app.component('chat', chat);

app.mount("#app");
// Echo.private('chat-channel')
//     .listen('SendMessage', (e) => {
//         messages.value.push({
//             message: e.message.message, 
//             user: e.user
//         });
//     })
