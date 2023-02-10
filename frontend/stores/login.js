import { defineStore } from "pinia";
import axios from "axios";
import { apiHost, apiLogin} from "~/config/api.js";

export const useLoginStore = defineStore('LoginStore', () => {
    const isLoginPageShow = ref(false);
    const formData = reactive({});

    const showPage = () => {
        isLoginPageShow.value = !isLoginPageShow.value;
        console.log(isLoginPageShow.value)
    }
    const closeModalOutside = (event) => {
        if (event.target.id === 'modal-overlay') {
            showPage();
        }
    }
    const loginAction = async () => {
        const result = await axios.post(`${apiHost}/${apiLogin}`,{
            email: formData.email,
            password: formData.password
        });
        console.log(formData);
    }

    return { isLoginPageShow, showPage, loginAction, formData, closeModalOutside };
})