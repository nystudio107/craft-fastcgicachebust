module.exports = {
  title: 'FastCGI Cache Bust Plugin Documentation',
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
    repo: 'nystudio107/craft-fastcgicachebust',
    docsDir: 'docs/docs',
    docsBranch: 'v1',
    algolia: {
      appId: '3JUO5TO2MP',
      apiKey: '21bdcc520664f952bfd3f25e5549f384',
      indexName: 'nystudio107-fastcgi-cache-bust'
    },
    editLinks: true,
    editLinkText: 'Edit this page on GitHub',
    lastUpdated: 'Last Updated',
    sidebar: 'auto',
  },
};
