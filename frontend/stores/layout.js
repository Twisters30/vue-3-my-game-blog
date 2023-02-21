import { defineStore } from "pinia";

export const useLayoutStore = defineStore('layoutStore', () => {

    const layout = ref('default');
    const switchLayout = (layoutName) => {
        layout.value = layoutName;
    }
    return { layout, switchLayout };
})