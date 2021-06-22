import Home from './pages/Home';
import Register from './pages/Register';
import Login from './pages/Login';
import Platform from './pages/Platform';
import Wallet from './pages/Wallet';

export default [
    {
        path: '/',
        component: Home,
        name: 'home'
    },
    {
        path: '/register',
        component: Register,
        name: 'register'
    },
    {
        path: '/login',
        component: Login,
        name: 'login'
    },
    {
        path: '/platform',
        component: Platform,
        name: 'platform'
    },
    {
        path: '/Wallet',
        component: Wallet,
        name: 'wallet'
    }
];