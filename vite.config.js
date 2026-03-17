import { defineConfig } from 'vite';
import { resolve } from 'path';
import { readdirSync } from 'fs';

/**
 * Vite plugin: watch PHP templates so Tailwind class changes trigger a rebuild.
 * PHP files are in Tailwind's `content` array but not in Rollup's module graph,
 * so `vite build --watch` won't see them without this.
 */
function watchTemplates() {
	return {
		name: 'watch-templates',
		buildStart() {
			const blocksDir = resolve(__dirname, 'blocks');
			for (const file of readdirSync(blocksDir, { recursive: true })) {
				if (String(file).endsWith('.php')) {
					this.addWatchFile(resolve(blocksDir, String(file)));
				}
			}
		},
	};
}

export default defineConfig({
	plugins: [watchTemplates()],
	build: {
		outDir: 'dist',
		emptyOutDir: true,
		rollupOptions: {
			input: {
				'forest-blocks': resolve(__dirname, 'assets/css/forest-blocks.css'),
				editor: resolve(__dirname, 'src/css/editor.css'),
				main: resolve(__dirname, 'src/js/main.js'),
			},
			output: {
				entryFileNames: '[name].js',
				assetFileNames: '[name].[ext]',
			},
		},
	},
});
