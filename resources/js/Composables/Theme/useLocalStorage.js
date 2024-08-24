export default function useLocalStorage() {
    function setToLocalStorage(value, key) {
        localStorage.setItem(key, JSON.stringify(value))
    }

    function getFromLocalStorage(key) {
        return JSON.parse(localStorage.getItem(key));
    }

    return {
        setData: (value, key) => {
            setToLocalStorage(value, key);
        },

        getData: (key) => {
            return getFromLocalStorage(key);
        }
    }
}
