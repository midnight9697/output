import{A as n}from"./login-1e9ef6f5.js";import{G as r}from"./validation-825c0502.js";$(document).ready(function(){r.loginValidation(a=>{a.preventDefault();const e=$("#loginSegment .ui.dimmer");e.addClass("blinking"),document.getElementById("loader-text").innerHTML=`
            Authenticating...
        `,$("#loginSegment").dimmer("show"),n.authenticate({email:$("#email").val(),password:$("#password").val()},t=>{e.removeClass("blinking"),t.data.auth==1?(localStorage.setItem("bearer",t.data.bearer),localStorage.setItem("token_id",t.data.tokenId),setInterval(()=>{$("#loginSegment").dimmer("show",{silent:!0}).promise().done(()=>{e.removeClass("blinking").addClass("success"),setInterval(()=>{document.getElementById("loader-text").innerHTML=`
                            Success<br>
                            Please wait...
                        `,window.location="./dashboard"})})},500)):($(".ui.form").form("add errors",["Invalid username or password."]),$("#loginSegment").dimmer("show",{silent:!0}).promise().done(()=>{document.getElementById("loader-text").innerHTML=`
                        Incorrect username or password
                    `,e.removeClass("blinking").addClass("failure")}),setInterval(()=>{$("#loginSegment").dimmer("hide",{silent:!0}).promise().done(()=>{e.removeClass("failure").addClass("blinking")})},500))})})});
