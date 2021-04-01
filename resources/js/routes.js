const CardsList = () => import('./vue/cards/list.vue')
const CardsCreate = () => import('./vue/cards/add.vue')
const CardsEdit = () => import('./vue/cards/edit.vue')

export const routes = [
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
        name: 'cardsAdd',
        path: '/cards/add',
        component: CardsCreate
    }
]