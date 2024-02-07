"use strict";(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[5991],{4692:(e,o,n)=>{n.r(o),n.d(o,{assets:()=>r,contentTitle:()=>s,default:()=>m,frontMatter:()=>i,metadata:()=>a,toc:()=>d});var t=n(5893),c=n(1151);const i={title:"Accordion"},s=void 0,a={id:"components/accordion",title:"Accordion",description:"The accordion component allows you to display much information in a smaller place using collapsible spaces.",source:"@site/docs/components/accordion.md",sourceDirName:"components",slug:"/components/accordion",permalink:"/docs/components/accordion",draft:!1,unlisted:!1,tags:[],version:"current",frontMatter:{title:"Accordion"},sidebar:"tutorialSidebar",previous:{title:"Intro",permalink:"/docs/components/intro"},next:{title:"Blog Post Card",permalink:"/docs/components/blog-post-card"}},r={},d=[{value:"Usage",id:"usage",level:2}];function l(e){const o={code:"code",h2:"h2",img:"img",li:"li",p:"p",pre:"pre",ul:"ul",...(0,c.a)(),...e.components};return(0,t.jsxs)(t.Fragment,{children:[(0,t.jsx)(o.p,{children:"The accordion component allows you to display much information in a smaller place using collapsible spaces."}),"\n",(0,t.jsx)(o.p,{children:(0,t.jsx)(o.img,{alt:"accordion.png",src:n(6169).Z+"",width:"2514",height:"928"})}),"\n",(0,t.jsx)(o.h2,{id:"usage",children:"Usage"}),"\n",(0,t.jsx)(o.pre,{children:(0,t.jsx)(o.code,{className:"language-html",children:'<x-accordion class="mt-4 p-8">\n    <x-accordion.item active="true" name="refund">\n        <x-slot name="title">Do you offer a refund?</x-slot>\n\n        Yes, we do offer a 30 days money back guarantee.\n\n    </x-accordion.item>\n\n    <x-accordion.item active="false" name="trial">\n        <x-slot name="title">Do you offer a trial?</x-slot>\n\n        Yes, we do offer a 30 days free trial.\n    </x-accordion.item>\n</x-accordion>\n'})}),"\n",(0,t.jsx)(o.p,{children:"You can pass in extra classes to the accordion component to customize it's look and feel."}),"\n",(0,t.jsxs)(o.p,{children:["The accordion item ",(0,t.jsx)(o.code,{children:"x.accordion-item"})," component is used to display the content of each accordion item. It accepts the following attributes:"]}),"\n",(0,t.jsxs)(o.ul,{children:["\n",(0,t.jsxs)(o.li,{children:[(0,t.jsx)(o.code,{children:"name"})," - the name of the accordion item. This is used to identify the accordion item."]}),"\n",(0,t.jsxs)(o.li,{children:[(0,t.jsx)(o.code,{children:"active"})," - whether the accordion item is active or not. This is used to determine if the accordion item should be expanded or not."]}),"\n"]})]})}function m(e={}){const{wrapper:o}={...(0,c.a)(),...e.components};return o?(0,t.jsx)(o,{...e,children:(0,t.jsx)(l,{...e})}):l(e)}},6169:(e,o,n)=>{n.d(o,{Z:()=>t});const t=n.p+"assets/images/accordion-02f179542bbcb0d07762f41159536e2f.png"},1151:(e,o,n)=>{n.d(o,{Z:()=>a,a:()=>s});var t=n(7294);const c={},i=t.createContext(c);function s(e){const o=t.useContext(i);return t.useMemo((function(){return"function"==typeof e?e(o):{...o,...e}}),[o,e])}function a(e){let o;return o=e.disableParentContext?"function"==typeof e.components?e.components(c):e.components||c:s(e.components),t.createElement(i.Provider,{value:o},e.children)}}}]);