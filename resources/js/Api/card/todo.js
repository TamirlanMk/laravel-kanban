import {route} from "../../../../vendor/tightenco/ziggy/src/js/index.js";

export const getCardTodos = (cardId) => {
    return axios.get(route('cards.todos.index', {card: cardId}))
        .then((res) => {
            return res.data;
        }).catch(e => {
            throw e;
        });
}

export const storeCardTodo = (cardId, data) => {
    return axios.post(route('cards.todos.store', {card: cardId}), data)
        .then((res) => {
            return res.data;
        }).catch(e => {
            throw e;
        });
}

export const updateCardTodo = (todoId, {name, is_checked}) => {
    return axios.put(route('cards.todos.update', {card_todo: todoId}), {name, is_checked})
        .then((res) => {
            return res.data;
        }).catch(e => {
            throw e;
        })
}

export const updateReorderedCardTodos = (cardId, todos) => {
    return axios.put(route('cards.todos.sorting', {card: cardId}), {
        todos: todos
    })
        .then((res) => {
            return res.data;
        }).catch(e => {
            throw e;
        })
}

export const deleteCardTodo = (todoId) => {
    return axios.delete(route('cards.todos.delete', {card_todo: todoId}))
        .then((res) => {
            return res.data;
        }).catch(e => {
            throw e;
        });
}
