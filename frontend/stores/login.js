import { defineStore } from "pinia";
// import { ref } from 'vue';

export const useLoginStore = defineStore('LoginStore', () => {
    const isLoginPageShow = ref(false);
    
    const showPage = () => {
        isLoginPageShow.value = !isLoginPageShow.value;
        console.log(isLoginPageShow.value)
    }

    return { isLoginPageShow, showPage };  
})