<template>
  <div class="container">
    <div class="center">
      <button class="btn" :type="btnType" :style="{ background: btnColor }">
        <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
          <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
          <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
        </svg>
        <span :style="{ color: btnTextColor }">{{ btnText }}</span>
      </button>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from "vue";

defineProps({
  btnColor: {
    type: String,
    default: "transparent",
  },
  btnType: {
    type: String,
    default: () => "button",
  },
  btnTextColor: {
    type: String,
    default: () => "#fff",
  },
  btnText: {
    type: String,
    default: "нажми на меня",
  },
});
</script>

<style scoped>
.container {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 7px;
}

.center {
  width: 180px;
  height: 60px;
  position: relative;
}

.btn {
  width: 180px;
  height: 60px;
  cursor: pointer;
  background: transparent;
  border: 1px solid #91c9ff;
  border-radius: 7px;
  outline: none;
  transition: 1s ease-in-out;
}

svg {
  position: absolute;
  left: 0;
  top: 0;
  fill: none;
  stroke: #fff;
  stroke-dasharray: 150 480;
  stroke-dashoffset: 150;
  transition: 1s ease-in-out;
  border-radius: 7px;
}

.container.btn-animate svg {
  transition: 1s ease-in-out;
  stroke-dashoffset: -480;
}

.btn:hover svg {
  stroke-dashoffset: -480;
}
.btn span {
  font-size: 18px;
  font-weight: 100;
}
.btn:hover span {
  color: #00a87d !important;
  transition: 0.3s ease-in-out;
}
</style>
