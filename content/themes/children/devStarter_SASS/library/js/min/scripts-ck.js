Modernizr.load([{test:Modernizr.borderradius,nope:[]}]),jQuery(document).ready(function(t){var e=t(window).width();e>768&&t(".comment img[data-gravatar]").each(function(){t(this).attr("src",t(this).attr("data-gravatar"))})}),function(t){function e(){r.setAttribute("content",d),u=!0}function a(){r.setAttribute("content",c),u=!1}function n(n){f=n.accelerationIncludingGravity,s=Math.abs(f.x),m=Math.abs(f.y),v=Math.abs(f.z),!t.orientation&&(s>7||(v>6&&8>m||8>v&&m>6)&&s>5)?u&&a():u||e()}if(/iPhone|iPad|iPod/.test(navigator.platform)&&navigator.userAgent.indexOf("AppleWebKit")>-1){var i=t.document;if(i.querySelector){var r=i.querySelector("meta[name=viewport]"),o=r&&r.getAttribute("content"),c=o+",maximum-scale=1",d=o+",maximum-scale=10",u=!0,s,m,v,f;r&&(t.addEventListener("orientationchange",e,!1),t.addEventListener("devicemotion",n,!1))}}}(this);