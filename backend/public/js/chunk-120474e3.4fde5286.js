(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-120474e3"],{"1e4b":function(e,t,c){"use strict";c.r(t);var s=c("7a23");const o=e=>(Object(s["pushScopeId"])("data-v-0ec89142"),e=e(),Object(s["popScopeId"])(),e),n={class:"post__wrapper line"},a={class:"post__title sub-title"},l={class:"post__left"},r=["src"],p=["innerHTML"],i={class:"post__footer-wrapper"},b={class:"post__footer"},d={class:"post__author"},u=o(()=>Object(s["createElementVNode"])("span",{class:"post__separator"},"|",-1)),j={class:"post__date"};var O={__name:"Post",props:["post"],setup(e){return(t,c)=>(Object(s["openBlock"])(),Object(s["createElementBlock"])("div",null,[Object(s["createElementVNode"])("div",n,[Object(s["createElementVNode"])("h3",a,Object(s["toDisplayString"])(e.post.name),1),Object(s["createElementVNode"])("div",l,[Object(s["createElementVNode"])("img",{class:"post__image",src:e.post.image,alt:"Изображение статьи"},null,8,r),Object(s["createElementVNode"])("p",{innerHTML:e.post.description,class:"post__text-preview cut-text"},null,8,p)]),Object(s["createElementVNode"])("div",i,[Object(s["createElementVNode"])("div",b,[Object(s["createElementVNode"])("span",d,Object(s["toDisplayString"])(e.post.author_name),1),u,Object(s["createElementVNode"])("span",j,Object(s["toDisplayString"])(e.post.created_at),1)])])])]))}},_=(c("96eb"),c("6b0d")),m=c.n(_);const v=m()(O,[["__scopeId","data-v-0ec89142"]]);var f=v,E=c("be92"),g=c("a3be"),k=c("cee4");const w=Object(E["defineStore"])("postsStore",()=>{const e=Object(s["ref"])(null),t=async()=>{e.value||console.log(e);try{const t=await k["a"].get(`${g["g"]}/${g["f"]}`);200===t.status&&(e.value=t.data)}catch(t){console.log(t)}return e.value};return{getPosts:t}}),N=Object(s["createElementVNode"])("h1",{class:"main-title"},"Articles",-1),V={class:"post__feed"};var h={__name:"index",async setup(e){let t,c;const o=w(),n=([t,c]=Object(s["withAsyncContext"])(()=>o.getPosts()),t=await t,c(),t);return console.log(n),(e,t)=>(Object(s["openBlock"])(),Object(s["createElementBlock"])("div",null,[N,Object(s["createElementVNode"])("div",V,[(Object(s["openBlock"])(!0),Object(s["createElementBlock"])(s["Fragment"],null,Object(s["renderList"])(Object(s["unref"])(n),e=>(Object(s["openBlock"])(),Object(s["createBlock"])(f,{post:e,key:e.id},null,8,["post"]))),128))])]))}};c("506c");const y=h;t["default"]=y},"506c":function(e,t,c){"use strict";c("d57b")},"96eb":function(e,t,c){"use strict";c("f9ce")},d57b:function(e,t,c){},f9ce:function(e,t,c){}}]);
//# sourceMappingURL=chunk-120474e3.4fde5286.js.map