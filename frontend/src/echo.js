import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const echo = new Echo({
    broadcaster: 'pusher',
    key: 'bad4962d55e08304a906',
    cluster: 'ap1',
    encrypted: true,
});

export default echo;
