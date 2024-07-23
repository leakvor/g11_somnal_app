import Pusher from 'pusher-js'
Pusher.logToConsole = true
const pusher = new Pusher('bec132b602f9fc02212e', {
  cluster: 'ap1',
  encrypted: true
})
export default pusher
