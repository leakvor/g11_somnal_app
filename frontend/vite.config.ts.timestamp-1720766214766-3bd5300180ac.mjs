// vite.config.ts
import { fileURLToPath, URL } from "node:url";
import { defineConfig } from "file:///C:/Users/leakv/OneDrive/Desktop/vc2%20su/g11_somnal_app/frontend/node_modules/vite/dist/node/index.js";
import vue from "file:///C:/Users/leakv/OneDrive/Desktop/vc2%20su/g11_somnal_app/frontend/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import vueJsx from "file:///C:/Users/leakv/OneDrive/Desktop/vc2%20su/g11_somnal_app/frontend/node_modules/@vitejs/plugin-vue-jsx/dist/index.mjs";
import VueDevTools from "file:///C:/Users/leakv/OneDrive/Desktop/vc2%20su/g11_somnal_app/frontend/node_modules/vite-plugin-vue-devtools/dist/vite.mjs";
import Unocss from "file:///C:/Users/leakv/OneDrive/Desktop/vc2%20su/g11_somnal_app/frontend/node_modules/unocss/dist/vite.mjs";
import { presetAttributify, presetUno } from "file:///C:/Users/leakv/OneDrive/Desktop/vc2%20su/g11_somnal_app/frontend/node_modules/unocss/dist/index.mjs";
var __vite_injected_original_import_meta_url = "file:///C:/Users/leakv/OneDrive/Desktop/vc2%20su/g11_somnal_app/frontend/vite.config.ts";
var vite_config_default = defineConfig({
  plugins: [
    vue(),
    vueJsx(),
    VueDevTools(),
    Unocss({
      presets: [presetAttributify(), presetUno()]
    })
  ],
  resolve: {
    alias: {
      "@": fileURLToPath(new URL("./src", __vite_injected_original_import_meta_url))
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcudHMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxVc2Vyc1xcXFxsZWFrdlxcXFxPbmVEcml2ZVxcXFxEZXNrdG9wXFxcXHZjMiBzdVxcXFxnMTFfc29tbmFsX2FwcFxcXFxmcm9udGVuZFwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiQzpcXFxcVXNlcnNcXFxcbGVha3ZcXFxcT25lRHJpdmVcXFxcRGVza3RvcFxcXFx2YzIgc3VcXFxcZzExX3NvbW5hbF9hcHBcXFxcZnJvbnRlbmRcXFxcdml0ZS5jb25maWcudHNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0M6L1VzZXJzL2xlYWt2L09uZURyaXZlL0Rlc2t0b3AvdmMyJTIwc3UvZzExX3NvbW5hbF9hcHAvZnJvbnRlbmQvdml0ZS5jb25maWcudHNcIjtpbXBvcnQgeyBmaWxlVVJMVG9QYXRoLCBVUkwgfSBmcm9tICdub2RlOnVybCdcclxuXHJcbmltcG9ydCB7IGRlZmluZUNvbmZpZyB9IGZyb20gJ3ZpdGUnXHJcbmltcG9ydCB2dWUgZnJvbSAnQHZpdGVqcy9wbHVnaW4tdnVlJ1xyXG5pbXBvcnQgdnVlSnN4IGZyb20gJ0B2aXRlanMvcGx1Z2luLXZ1ZS1qc3gnXHJcbmltcG9ydCBWdWVEZXZUb29scyBmcm9tICd2aXRlLXBsdWdpbi12dWUtZGV2dG9vbHMnXHJcbmltcG9ydCBVbm9jc3MgZnJvbSAndW5vY3NzL3ZpdGUnXHJcbmltcG9ydCB7IHByZXNldEF0dHJpYnV0aWZ5LCBwcmVzZXRVbm8gfSBmcm9tICd1bm9jc3MnIC8vIFByZXNldHNcclxuXHJcbi8vIGh0dHBzOi8vdml0ZWpzLmRldi9jb25maWcvXHJcbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XHJcbiAgcGx1Z2luczogW1xyXG4gICAgdnVlKCksXHJcbiAgICB2dWVKc3goKSxcclxuICAgIFZ1ZURldlRvb2xzKCksXHJcbiAgICBVbm9jc3Moe1xyXG4gICAgICBwcmVzZXRzOiBbcHJlc2V0QXR0cmlidXRpZnkoKSwgcHJlc2V0VW5vKCldXHJcbiAgICB9KVxyXG4gIF0sXHJcbiAgcmVzb2x2ZToge1xyXG4gICAgYWxpYXM6IHtcclxuICAgICAgJ0AnOiBmaWxlVVJMVG9QYXRoKG5ldyBVUkwoJy4vc3JjJywgaW1wb3J0Lm1ldGEudXJsKSlcclxuICAgIH1cclxuICB9XHJcbn0pXHJcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBOFgsU0FBUyxlQUFlLFdBQVc7QUFFamEsU0FBUyxvQkFBb0I7QUFDN0IsT0FBTyxTQUFTO0FBQ2hCLE9BQU8sWUFBWTtBQUNuQixPQUFPLGlCQUFpQjtBQUN4QixPQUFPLFlBQVk7QUFDbkIsU0FBUyxtQkFBbUIsaUJBQWlCO0FBUHNNLElBQU0sMkNBQTJDO0FBVXBTLElBQU8sc0JBQVEsYUFBYTtBQUFBLEVBQzFCLFNBQVM7QUFBQSxJQUNQLElBQUk7QUFBQSxJQUNKLE9BQU87QUFBQSxJQUNQLFlBQVk7QUFBQSxJQUNaLE9BQU87QUFBQSxNQUNMLFNBQVMsQ0FBQyxrQkFBa0IsR0FBRyxVQUFVLENBQUM7QUFBQSxJQUM1QyxDQUFDO0FBQUEsRUFDSDtBQUFBLEVBQ0EsU0FBUztBQUFBLElBQ1AsT0FBTztBQUFBLE1BQ0wsS0FBSyxjQUFjLElBQUksSUFBSSxTQUFTLHdDQUFlLENBQUM7QUFBQSxJQUN0RDtBQUFBLEVBQ0Y7QUFDRixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
