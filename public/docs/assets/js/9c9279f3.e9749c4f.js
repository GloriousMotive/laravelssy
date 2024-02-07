"use strict";(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[3295],{8497:(e,t,o)=>{o.r(t),o.d(t,{assets:()=>p,contentTitle:()=>c,default:()=>m,frontMatter:()=>d,metadata:()=>l,toc:()=>h});var n=o(5893),r=o(1151);const i=o.p+"assets/images/checkout-payments-d668acb0ed7decc2f1bf9a8a1d259345.png",a=o.p+"assets/images/payment-providers-cea18e517f098cc1aecd9205445900b6.png",s=o.p+"assets/images/payment-provider-credentials-eec21ca17a434c6bcedc0e3c1363ebd8.png",d={title:"Payment Providers",sidebar_position:5},c=void 0,l={id:"payment-providers",title:"Payment Providers",description:"SaaSykit comes with support for Stripe and Paddle out of the box. This allows you to start accepting payments from your customers right away.",source:"@site/docs/payment-providers.md",sourceDirName:".",slug:"/payment-providers",permalink:"/docs/payment-providers",draft:!1,unlisted:!1,tags:[],version:"current",sidebarPosition:5,frontMatter:{title:"Payment Providers",sidebar_position:5},sidebar:"tutorialSidebar",previous:{title:"Discounts",permalink:"/docs/discounts"},next:{title:"OAuth Social Login",permalink:"/docs/oauth-social-login"}},p={},h=[{value:"Configuring Your Payment Providers",id:"configuring-your-payment-providers",level:2},{value:"Proration",id:"proration",level:2},{value:"More Payment Providers",id:"more-payment-providers",level:2}];function u(e){const t={a:"a",admonition:"admonition",code:"code",h2:"h2",p:"p",strong:"strong",...(0,r.a)(),...e.components};return(0,n.jsxs)(n.Fragment,{children:[(0,n.jsxs)(t.p,{children:[(0,n.jsx)(t.strong,{children:"SaaSykit"})," comes with support for ",(0,n.jsx)(t.a,{href:"https://stripe.com/",children:"Stripe"})," and ",(0,n.jsx)(t.a,{href:"https://paddle.com/",children:"Paddle"})," out of the box. This allows you to start accepting payments from your customers right away."]}),"\n",(0,n.jsxs)(t.p,{children:["You can enable/disable any of these providers at any time and ",(0,n.jsx)(t.strong,{children:"SaaSykit"})," will do the heavy lifting for you and your customers will be able to pay you using the payment provider you have enabled."]}),"\n",(0,n.jsx)(t.admonition,{type:"note",children:(0,n.jsx)(t.p,{children:"You can enable multiple payment providers at the same time and leave it up to your customers to choose which payment provider they want to use to pay you."})}),"\n",(0,n.jsx)("img",{src:i,alt:"Checkout payments",width:"800",class:"image"}),"\n",(0,n.jsxs)(t.p,{children:["You can also accept payments via ",(0,n.jsx)(t.code,{children:"PayPal"}),", ",(0,n.jsx)(t.code,{children:"Apple Pay"}),", ",(0,n.jsx)(t.code,{children:"Google Pay"}),", ",(0,n.jsx)(t.code,{children:"Klarna"}),", ",(0,n.jsx)(t.code,{children:"iDeal"})," and more through ",(0,n.jsx)(t.code,{children:"Stripe"})," and ",(0,n.jsx)(t.code,{children:"Paddle"}),"."]}),"\n",(0,n.jsx)(t.h2,{id:"configuring-your-payment-providers",children:"Configuring Your Payment Providers"}),"\n",(0,n.jsxs)(t.p,{children:["First, you will need to create a ",(0,n.jsx)(t.a,{href:"https://stripe.com/",children:"Stripe"})," and/or ",(0,n.jsx)(t.a,{href:"https://paddle.com/",children:"Paddle"})," account. Once you have created your accounts, you will need to get your credentials from each provider."]}),"\n",(0,n.jsx)(t.p,{children:'To configure your payment providers, go to the Admin Panel and under "Settings" click on "Payment Providers". You will be redirected to the payment providers settings page.'}),"\n",(0,n.jsx)("img",{src:a,alt:"Payment providers",width:"800",class:"image"}),"\n",(0,n.jsx)(t.p,{children:'Click on the payment provider you want to configure, and using the toggle "is active" you can enable/disable the payment provider.'}),"\n",(0,n.jsx)(t.p,{children:'Once you enable a payment provider, you will need to configure the credentials for that payment provider. To do that, click on the payment provider you want to configure, then click on "Edit credentials". You will be redirected to the payment provider credentials page.'}),"\n",(0,n.jsx)("img",{src:s,alt:"Credentials",width:"800",class:"image"}),"\n",(0,n.jsx)(t.p,{children:"Follow the instructions shown on the right-hand-side of the payment provider credentials page to get the credentials for the payment provider you want to configure."}),"\n",(0,n.jsx)(t.h2,{id:"proration",children:"Proration"}),"\n",(0,n.jsxs)(t.p,{children:[(0,n.jsx)(t.strong,{children:"SaaSykit"})," comes with support for proration out of the box. This allows you to adjust how your customer will be billed when they change their plans (upgrade/downgrade). If proration is enabled, when a customer upgrades or downgrades their subscription, the amount they have already paid will be prorated and credited towards their new plan."]}),"\n",(0,n.jsx)(t.p,{children:"For example, if a customer upgrades from a 10 USD per month plan to a 20 USD option, they\u2019re charged prorated amounts for the time spent on each plan. Assuming the change occurred halfway through the billing period, the customer is billed an additional 5 USD: -5 USD for unused time on the initial plan, and 10 USD for the remaining time on the new plan."}),"\n",(0,n.jsx)(t.p,{children:"When proration is disabled, your customer will be charged the full amount of the new plan when it's time to pay the next invoice (the next billing period)."}),"\n",(0,n.jsxs)(t.admonition,{type:"note",children:[(0,n.jsx)(t.p,{children:'It\'s a good idea to enable proration as this will reduce customer frustration and make the upgrade/downgrade process "fairer" to your customers.'}),(0,n.jsx)(t.p,{children:"But this defnitely differs from one business to another, so it's up to you to decide whether to enable proration or not."})]}),"\n",(0,n.jsxs)(t.p,{children:["To enable/disable proration, check ",(0,n.jsx)(t.a,{href:"/docs/settings",children:"settings"})," page."]}),"\n",(0,n.jsx)(t.h2,{id:"more-payment-providers",children:"More Payment Providers"}),"\n",(0,n.jsxs)(t.p,{children:[(0,n.jsx)(t.strong,{children:"SaaSykit"})," will add support for more payment providers in the future (Lemon Squeezy, and others), so stay tuned!"]})]})}function m(e={}){const{wrapper:t}={...(0,r.a)(),...e.components};return t?(0,n.jsx)(t,{...e,children:(0,n.jsx)(u,{...e})}):u(e)}},1151:(e,t,o)=>{o.d(t,{Z:()=>s,a:()=>a});var n=o(7294);const r={},i=n.createContext(r);function a(e){const t=n.useContext(i);return n.useMemo((function(){return"function"==typeof e?e(t):{...t,...e}}),[t,e])}function s(e){let t;return t=e.disableParentContext?"function"==typeof e.components?e.components(r):e.components||r:a(e.components),n.createElement(i.Provider,{value:t},e.children)}}}]);