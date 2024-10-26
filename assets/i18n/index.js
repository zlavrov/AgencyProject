import { createI18n } from 'vue-i18n'
import ent from './locales/en.json';
import uat from './locales/ua.json';

const i18n = createI18n({
    locale: localStorage.getItem('lang'),
    fallbackLocale: 'ua',
    legacy: false,
    messages: {
        en: ent,
        ua: uat
    }
});

export default i18n
