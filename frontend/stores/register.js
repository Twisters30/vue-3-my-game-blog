import { defineStore} from "pinia";
import axios from "axios";
import { apiHost, apiRegister} from "~/config/api";

export const useRegisterStore = defineStore('registerStore', () => {
    const formData = reactive({});
    const registerAction = async () => {
        const response = await axios.post(`${apiHost}/${apiRegister}`,{
            "name": formData.name,
            "email": formData.email,
            "password": formData.password,
        });
        console.log(formData, 'fromPiniaStore');
    }

    return { registerAction, formData };
})