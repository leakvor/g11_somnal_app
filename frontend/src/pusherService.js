import Pusher from 'pusher-js';
Pusher.logToConsole = true;
const pusher = new Pusher('224b59655bb8c43bf281', {
cluster: 'ap1',
encrypted: true
});

export default pusher;