export const getCardLabels = (cardId) => {
    return axios.get(route('cards.labels.index', {card: cardId}))
        .then((response) => {
            return response.data;
        })
        .catch((error) => {
            throw error;
        });
}

export const addCardLabel = (cardId, labelId) => {
    return axios.put(route('cards.labels.attach', {card: cardId, label: labelId}))
        .then((response) => {
            return response.data;
        })
        .catch((error) => {
            throw error;
        });
}

export const removeCardLabel = (cardId, labelId) => {
    return axios.put(route('cards.labels.detach', {card: cardId, label: labelId}))
        .then((response) => {
            return response.data;
        })
        .catch((error) => {
            throw error;
        });
}
