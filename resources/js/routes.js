const Welcome = () => import('./vue/Welcome.vue')

// cards
const CardsList = () => import('./vue/cards/list.vue')
const CardsCreate = () => import('./vue/cards/add.vue')
const CardsEdit = () => import('./vue/cards/edit.vue')
const CardsShow = () => import('./vue/cards/show.vue')

export const routes = [
    { 
        name: 'home',
        path: '/',
        component: Welcome
    },
    // cards
    { 
        name: 'cardsList',
        path: '/cards',
        component: CardsList
    },
    {
        name: 'cardsEdit',
        path: '/cards/:id/edit',
        component: CardsEdit
    },
    {
        name: 'cardsShow',
        path: '/cards/:id/show',
        component: CardsShow
    },
    {
        name: 'cardsAdd',
        path: '/cards/add',
        component: CardsCreate
    }
]