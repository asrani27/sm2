;/*FB_PKG_DELIM*/

__d("BTManifestName",["$InternalEnum"],(function(a,b,c,d,e,f){a=b("$InternalEnum")({MAIN:"main",LONGTAIL:"longtail"});c=a;f["default"]=c}),66);
__d("BtLongtailHashFalcoEvent",["FalcoLoggerInternal","getFalcoLogPolicy_DO_NOT_USE"],(function(a,b,c,d,e,f,g){"use strict";a=c("getFalcoLogPolicy_DO_NOT_USE")("5779");b=d("FalcoLoggerInternal").create("bt_longtail_hash",a);e=b;g["default"]=e}),98);
__d("CometBTManifestLoader",["BootloaderEvents","BtLongtailHashFalcoEvent","ClientConsistencyEventEmitter","FBLogger","ODS","Promise","SiteData","XHRRequest","asyncToGeneratorRuntime","err","promiseDone"],(function(a,b,c,d,e,f,g){"use strict";var h,i,j=new Set();function k(a,b,c,d){return l.apply(this,arguments)}function l(){l=b("asyncToGeneratorRuntime").asyncToGenerator(function*(a,d,e,f){var g=(yield new(i||(i=b("Promise")))(function(b,g){new(c("XHRRequest"))(a+"/btmanifest/"+e+"/"+d+"/"+f).setMethod("GET").setResponseHandler(function(a){return b(a.toString())}).setErrorHandler(function(a){return g(a)}).send()}));if(typeof g!=="string")throw c("FBLogger")("binary_transparency","bt_invalid_manifest_response").mustfixThrow("Invalid response from BT manifest endpoint");return g});return l.apply(this,arguments)}function m(a,b){(h||(h=d("ODS"))).bumpEntityKey(454,"obc.www.all","bt.comet_manifest_loader."+Number(d("SiteData").compose_bootloads)+"."+d("SiteData").pkg_cohort+"."+a+"."+b)}function n(a,b,d){var e;if(d instanceof Error)e=d;else if(typeof d==="object"){var f=JSON.stringify(d);e=c("err")("(XHRRequest): %s",f.slice(0,300)+(f.length>300?"...":""))}else e=c("err")(d);c("FBLogger")("binary_transparency","bt_download_manifest_error").catching(e).mustfix('Unable to download and inject BT manifest "%s" for version: %s',b,a)}function o(a,b){return p.apply(this,arguments)}function p(){p=b("asyncToGeneratorRuntime").asyncToGenerator(function*(a,b){if(!d("SiteData").manifest_origin||d("SiteData").manifest_version_prefix==null||d("SiteData").manifest_base_uri==null)return;var c=a+"_"+b;a=""+d("SiteData").manifest_version_prefix+a;if(j.has(c))return;m(b,"start");j.add(c);try{var e,f=document.createElement("script");f.innerText=(yield k(d("SiteData").manifest_base_uri,d("SiteData").manifest_origin,a,b));f.type="application/json";f.setAttribute("name","binary-transparency-manifest");f.dataset.manifestRev=a;f.dataset.manifestType=b;(e=document.head)==null?void 0:e.appendChild(f);m(b,"complete")}catch(d){m(b,"failed"),n(a,b,d),j["delete"](c)}});return p.apply(this,arguments)}function a(){c("promiseDone")(o(d("SiteData").client_revision,"main")),d("BootloaderEvents").onResourceInLongTailBTManifest(function(a){c("promiseDone")(o(d("SiteData").client_revision,"longtail")),a.hashes.forEach(function(b){c("BtLongtailHashFalcoEvent").log(function(){return{client_revision:String(d("SiteData").client_revision),compose_bootloads:d("SiteData").compose_bootloads,ef_page:d("SiteData").ef_page||"",hash:b,pkg_cohort:d("SiteData").pkg_cohort,reference:a.source,rls_id:d("SiteData").hsi}})})}),c("ClientConsistencyEventEmitter").addListener("newRevision",function(a){c("promiseDone")(o(a,"main")),c("promiseDone")(o(a,"longtail"))})}g.init=a}),98);
__d("CometToasterView_DO_NOT_USE.react",["BaseContextualLayerAnchorRoot.react","BasePortal.react","BaseToastAnimationInternal.react","XPlatReactToasterView.react","gkx","react","useToasterStateManager"],(function(a,b,c,d,e,f,g){"use strict";var h,i=h||(h=d("react"));b=h;var j=b.useEffect,k=b.useState,l={list:{display:"x78zum5",flexDirection:"xdt5ytf",listStyle:"xe8uvvx",maxWidth:"x193iq5w",$$css:!0},root:{bottom:"x1ey2m1c",display:"x78zum5",end:"xds687c",left:null,right:null,pointerEvents:"x47corl",position:"xixxii4",start:"x1uvyrtv",zIndex:"xoegz02",$$css:!0},rootBlue:{zIndex:"x1jvg36b",$$css:!0},rootWorkplaceLegacy:{zIndex:"xdwmgzo",$$css:!0},toast:{paddingTop:"xyamay9",paddingEnd:"x1pi30zi",paddingBottom:"x1l90r2v",paddingStart:"x1swvt13",pointerEvents:"x71s49j","@media (max-width: 899px)_maxWidth":"xx1nl2z",$$css:!0}},m={center:{justifyContent:"xl56j7k",$$css:!0},end:{justifyContent:"x13a6bvl",$$css:!0},start:{justifyContent:"x1nhvcw1",$$css:!0}},n={full:{maxWidth:"x193iq5w",$$css:!0},regular:{maxWidth:"xpqan2r",$$css:!0}};function a(a){var b=a.align;b=b===void 0?"start":b;var d=a.filterToasts,e=a.maxVisible;e=e===void 0?1:e;a=a.maxWidth;var f=a===void 0?"full":a,g=c("useToasterStateManager")();a=k(function(){return g.getEmptyState()});var h=a[0],o=a[1];j(function(){var a=g.registerView(o,0);return a.remove},[g]);return i.jsx(c("BasePortal.react"),{target:document.body,xstyle:[l.root,c("gkx")("708253")?null:c("gkx")("1341692")?l.rootWorkplaceLegacy:l.rootBlue,m[b]],children:i.jsx("ul",{className:"x78zum5 xdt5ytf xe8uvvx x193iq5w",children:i.jsx(c("XPlatReactToasterView.react"),{filterToasts:d,maxVisible:e,onExpireToast:function(a){g.expire(a)},toasterState:h,children:function(a,b,d,e){return i.jsx(c("BaseToastAnimationInternal.react"),{expired:d,id:b,position:e,xstyle:[l.toast,n[c("gkx")("1196")?"regular":f]],children:i.jsx(c("BaseContextualLayerAnchorRoot.react"),{children:a})},e)}})})})}a.displayName=a.name+" [from "+f.id+"]";g["default"]=a}),98);