import { defineConfig } from 'vite'
import { svelte } from '@sveltejs/vite-plugin-svelte'
import { VitePWA } from 'vite-plugin-pwa'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    svelte(),
    VitePWA({
      injectRegister: 'auto',
      registerType: 'autoUpdate',
      workbox: {
        globPatterns: ['**/*.{js,css,html,ico,png,svg}']
      },
      manifest: {
        name: 'video streamer',
        short_name: 'vidBethro',
        description: 'video player app',
        theme_color: '#ffffff',
        icons: [
          {
            src: 'web/icon-192.png',
            sizes: '192x192',
            type: 'image/png'
          },
          {
            src: 'web/icon-192-maskable.png',
            sizes: '192x192',
            type: 'image/png',
            purpose: 'maskable'
          },
          {
            src: 'web/icon-512.png',
            sizes: '512x512',
            type: 'image/png'
          },
          {
            src: 'web/icon-512-maskable.png',
            sizes: '512x512',
            type: 'image/png',
            purpose: 'maskable'
          }
        ]
      }
    })
  ],
  optimizeDeps: {
    exclude: ['js-big-decimal']
  },
  build: {
    target: 'esnext',
    outDir: '../public',
  }
})
