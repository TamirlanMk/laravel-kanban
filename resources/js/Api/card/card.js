import {route} from "../../../../vendor/tightenco/ziggy/src/js/index.js";

export const getCard = (cardId) => {
    return axios.get(route('cards.show', {
        card: cardId
    })).then((res) => {
        return res.data;
    }).catch(e => {
        console.error(e)
    });
}

export const updateCard = (cardId, data) => {
    return axios.put(route('cards.update', {
        card: cardId
    }), data).then((res) => {
        return res.data;
    }).catch(e => {
        throw e;
    });
}
