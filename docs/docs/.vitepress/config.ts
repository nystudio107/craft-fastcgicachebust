import {defineConfig} from 'vitepress'

export default defineConfig({
  title: 'FastCGI Cache Bust Plugin',
  description: 'Documentation for the FastCGI Cache Bust plugin',
  base: '/docs/fastcgi-cache-bust/',
  lang: 'en-US',
  head: [
    ['meta', {content: 'https://github.com/nystudio107', property: 'og:see_also',}],
    ['meta', {content: 'https://twitter.com/nystudio107', property: 'og:see_also',}],
    ['meta', {content: 'https://youtube.com/nystudio107', property: 'og:see_also',}],
    ['meta', {content: 'https://www.facebook.com/newyorkstudio107', property: 'og:see_also',}],
  ],
  themeConfig: {
    socialLinks: [
      {icon: 'github', link: 'https://github.com/nystudio107'},
      {icon: 'twitter', link: 'https://twitter.com/nystudio107'},
    ],
    logo: '/img/plugin-logo.svg',
    editLink: {
      pattern: 'https://github.com/nystudio107/craft-fastcgicachebust/edit/develop-v3/docs/docs/:path',
      text: 'Edit this page on GitHub'
    },
    algolia: {
      appId: '3JUO5TO2MP',
      apiKey: '21bdcc520664f952bfd3f25e5549f384',
      indexName: 'nystudio107-fastcgi-cache-bust'
    },
    lastUpdatedText: 'Last Updated',
    sidebar: [],
    nav: [
      {text: 'Home', link: 'https://nystudio107.com/plugins/fastcgi-cache-bust'},
      {text: 'Store', link: 'https://plugins.craftcms.com/fastcgi-cache-bust'},
      {text: 'Changelog', link: 'https://nystudio107.com/plugins/fastcgi-cache-bust/changelog'},
      {text: 'Issues', link: 'https://github.com/nystudio107/craft-fastcgicachebust/issues'},
    ]
  },
});
