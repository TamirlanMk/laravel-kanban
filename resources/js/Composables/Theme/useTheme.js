import {onMounted, ref, watch} from "vue";
import useLocalStorage from "@/Composables/Theme/useLocalStorage.js";

const DARK_THEME_CLASS = 'dark';
const LOCALSTORAGE_THEME_KEY = 'dark-theme';

const useTheme = () => {
    const {setData, getData} = useLocalStorage();

    const isDark = ref(
        getData(LOCALSTORAGE_THEME_KEY)
        ?? checkPreferColorSchemeDark()
        ?? false
    );

    const toggleTheme = () => {
        if (isDark.value) {
            setData(false, LOCALSTORAGE_THEME_KEY);
        } else {
            setData(true, LOCALSTORAGE_THEME_KEY);
        }

        isDark.value = getData(LOCALSTORAGE_THEME_KEY)
    }

    onMounted(() => {
        toggleDarkThemeClass(isDark.value)
    })

    watch(() => isDark.value, () => {
        toggleDarkThemeClass(isDark.value)
    })

    return {
        isDark,
        toggleTheme: () => toggleTheme()
    };
}

const toggleDarkThemeClass = (isDark) => {
    if (isDark) {
        window.document.body.classList.add(DARK_THEME_CLASS);
    } else {
        window.document.body.classList.remove(DARK_THEME_CLASS);
    }
}

const checkPreferColorSchemeDark = () => {
    return window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)').matches : undefined;
}

export default useTheme;
