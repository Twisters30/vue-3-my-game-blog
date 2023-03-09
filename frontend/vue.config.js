const path = require("path");

module.exports = {
  outputDir: "../backend/public/js",
  configureWebpack: {
    resolve: {
      alias: {
        "~": path.join(__dirname, "/src"),
      },
    },
  },
  css: {
    loaderOptions: {
      scss: {
        prependData: `
          @import "@/assets/scss/global.scss";
        `,
      },
    },
  },
};
