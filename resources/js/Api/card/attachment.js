import {route} from "../../../../vendor/tightenco/ziggy/src/js/index.js";

export const getCardAttachments = (cardId) => {
    return axios.get(route('cards.attachments.index', {card: cardId}))
        .then((res) => {
            return res.data;
        }).catch(e => {
            throw e;
        });
}

export const storeCardAttachment = (cardId, data) => {
    return axios.post(route('cards.attachments.store', {card: cardId}), data, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then((res) => {
        return res.data;
    })
}

export const deleteCardAttachment = (attachmentId) => {
    return axios.delete(route('cards.attachments.delete', {card_attachment: attachmentId}))
        .then((res) => {
            return res.data;
        }).catch(e => {
            throw e;
        });
}
