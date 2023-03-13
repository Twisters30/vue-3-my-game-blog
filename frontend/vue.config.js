const path = require("path");

module.exports = {
  publicPath: "/",
  indexPath: "main.php",
  // Добавляем это:
  chainWebpack: (config) => {
    if (process.env.NODE_ENV === "production") {
      config.plugin("html").tap((args) => {
        args[0].template = path.join(__dirname, "../backend/public/main.php");
        args[0].minify.removeAttributeQuotes = false;
        return args;
      });
    }
  },
  outputDir: "../backend/public",
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
