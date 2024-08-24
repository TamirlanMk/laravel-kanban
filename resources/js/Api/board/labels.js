import axios from "axios";

export const getBoardLabels = (boardId) => {
    return axios.get(
        route('boards.labels.index', {
            board: boardId
        }))
        .then((response) => {
            return response.data;
        })
        .catch((error) => {
            throw error;
        });
}

export const createBoardLabel = (boardId, data) => {
    return axios.post(route('boards.labels.store', {
            board: boardId
        }), data)
        .then((response) => {
            return response.data;
        });
}

export const deleteBoardLabel = (labelId) => {
    return axios.delete(route('boards.labels.delete', {
            board_label: labelId
        }))
        .catch((error) => {
            throw error;
        });
}
