/*---------------------------------------------------------
jQuery Required for Slippa Script by Onlinetoolhub
Project:    Slippa - Domain & Website Marketplace -  V 1.0
Version:    V 1.0
Last change:    20.04.2020
Assigned to:    Onlinetoolhub
----------------------------------------------------------*/

    bootstrap_alert = function() {}
		bootstrap_alert.success = function(message,settings) {
		$(settings).html('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><span>'+message+'</span></div>')
		$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    	$(".alert-success").slideUp(500);
    	});
  	}
    	bootstrap_alert.alert = function(message,settings) {
    	$(settings).html('<div class="alert"><a class="close" data-dismiss="alert">×</a><span>'+message+'</span></div>')
    	$(".alert").fadeTo(2000, 500).slideUp(500, function(){
    	$(".alert").slideUp(500);
    	});
    }
        bootstrap_alert.warning = function(message,settings) {
        $(settings).html('<div class="alert alert-warning"><a class="close" data-dismiss="alert">×</a><span>'+message+'</span></div>')
        $(".alert-warning").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-warning").slideUp(500);
        });
    }
        bootstrap_alert.error = function(message,settings) {
        $(settings).html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><span>'+message+'</span></div>')
        $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-danger").slideUp(500);
        });
    }


    var includedAssets = [{ id: '64',name: '64KBPS'},
    { id: '128',name: '128KBPS'},
    { id: '192',name: '192KBPS'},
    { id: '256',name: '256KBPS'},
    { id: '320',name: '320KBPS'}
    ];


/*--------------------------------------------------*/
/* Clear all inputs after orm submit
/*--------------------------------------------------*/
    "use strict";
    function clearInputs(form){
      $('#'+form).find("input[type=text], textarea").val("");
    }

    "use strict";
    function populateIncludedAssets(countryElementId){

        var formatElement = document.getElementById(countryElementId);
        includedAssets.forEach(function(element) {
        
            formatElement.options[formatElement.length] = new Option(element['name'],element['id']);
        
        });
    }


/*--------------------------------------------------*/
/*  Validate Email
/*--------------------------------------------------*/
    "use strict";
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
/*--------------------------------------------------*/
/*  Validate URLs
/*--------------------------------------------------*/
    "use strict";
    function validateURL(str) {

        var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator

        var patternTokTok = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))');
        
        if(getDomainHost(str) === 'tiktok.com')
        {
            return !!patternTokTok.test(str);
        }

        return !!pattern.test(str);
    }


    function validateURLs(str){ 
         var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator

        return pattern.test(str);
    }

    function isUrlValid(url) {
        return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
    }

    function IsvalidDomain(domainName) {
        if (domainName!= null && domainName!= undefined) {
            var pattern = new RegExp(/[^w{3}.]([a-zA-Z0-9]([a-zA-Z0-9-]{0,65}[a-zA-Z0-9])?.)+[a-zA-Z]{2,6}/igm);
            return pattern.test(domainName);
        }
        else {
            return false;
        }
    }


/*--------------------------------------------------*/
/*  Get Hostname
/*--------------------------------------------------*/
    function getHostName(url) {
        var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
        
        if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) {
            return match[2];
        }
        else 
        {
            return null;
        }
    }

/*--------------------------------------------------*/
/*  Get Hostname
/*--------------------------------------------------*/

    function getDomainHost(url) {
        
        var hostName = getHostName(url);
        var domain = hostName;
    
        if (hostName != null) {
        var parts = hostName.split('.').reverse();
        
            if (parts != null && parts.length > 1) {
                domain = parts[1] + '.' + parts[0];
                
                if (hostName.toLowerCase().indexOf('.co.uk') != -1 && parts.length > 2) {
                    domain = parts[2] + '.' + domain;
                }
            }
        }

        return domain;
    }

/*--------------------------------------------------*/
/*  Blacklisted Domain Check
/*--------------------------------------------------*/
    "use strict";
    function CheckBlacklistedDomains(url,callback){
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        var status = null;
        $.ajax({
            url: baseUrl+'common/CheckBlacklistedDomains/',
            data: {[csrfName]: csrfHash},
            dataType: "json",
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if(data !==''){
                    var results =JSON.parse(data.response);

                    if(results.indexOf(getDomainHost(url)) === -1)
                    {
                        status = false;
                    }
                    else
                    {
                        status = true;
                    }

                    if(callback) callback(status);
                }
            }
        });
    }

/*--------------------------------------------------*/
/*  Blacklisted Domain Check
/*--------------------------------------------------*/
    "use strict";
    function CheckPlaystoreApp(url,callback){
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        var status = null;
        $.ajax({
            url: baseUrl+'common/validateApp/',
            type:"POST",
            data: {appurl: url,[csrfName]: csrfHash},
            dataType: "json",
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if(data.response === true){
                    status = true;
                }
                else
                {
                    status = false;
                }

                if(callback) callback(status);
            }
        });
    }


/*--------------------------------------------------*/
/*  Valid Platforms Check
/*--------------------------------------------------*/
    "use strict";
    function CheckPlatformURL(url,callback){
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        var status = null;
        $.ajax({
            url: baseUrl+'common/GetPlatformDomain/',
            type:"POST",
            data: {platform_domain: extractHostname(url),[csrfName]: csrfHash},
            dataType: "json",
            success: function (data) {
                $('.txt_csrfname').val(data.token);
                if(data.response === true){
                    status = true;
                }
                else
                {
                    status = false;
                }

                if(callback) callback(status);
            }
        });
    }

/*--------------------------------------------------*/
/*  Extract  Hostname
/*--------------------------------------------------*/
function extractHostname(url) {
    var hostname;

    if (url.indexOf("//") > -1) {
        hostname = url.split('/')[2];
    }
    else {
        hostname = url.split('/')[0];
    }

    hostname = hostname.split(':')[0];
    hostname = hostname.split('?')[0];
    return hostname;
}

    "use strict";
    $("#analyticsAccountDrop").change(function () {
        var accountID   = this.value;
        var domain   = $('#domainID').val();
        if(accountID !== 'false')
        {
            populateProperties(accountID,domain);
            $('#analyticsPropertyDrop').prop('disabled', false); 
        }
        else
        {
            $('#analyticsPropertyDrop').prop('disabled', true);
            $('#analyticsViewDrop').prop('disabled', true);
            $("#authenticationBtn").removeAttr('href');
        }
    });

    "use strict";
    function populateProperties(accountId,domainId){
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        $('#loadingImageAuthentication').show();
        var formatElement = document.getElementById('analyticsPropertyDrop');

        $.getJSON(baseUrl+'analytics/ListProperties/'+accountId+'/'+domainId,{[csrfName]: csrfHash},function(properties){
            $('.txt_csrfname').val(properties.token); 
            $('#analyticsPropertyDrop').find('option').remove().end();

            formatElement.options[0] = new Option('Select Property','false');
            properties.response.forEach(function(element) {
      
                formatElement.options[formatElement.length] = new Option(element['name'],element['id']);
            });

            $('#loadingImageAuthentication').hide();
        });
    }

    "use strict";
    $("#analyticsPropertyDrop").change(function () {
        var accountID   = $('#analyticsAccountDrop').val();
        var propertyID  = this.value;
        var domain      = $('#domainID').val();
        if(accountID !== 'false' && propertyID !== 'false')
        {
            populateViews(accountID,propertyID,domain);
            $('#analyticsViewDrop').prop('disabled', false); 
        }
        else
        {
            $('#analyticsViewDrop').prop('disabled', true);
            $("#authenticationBtn").removeAttr('href');
        }
    });

    "use strict";
    function populateViews(accountId,propertyId,domain){
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        $('#loadingImageAuthentication').show();
        var formatElement = document.getElementById('analyticsViewDrop');

        $.getJSON(baseUrl+'analytics/ListViews/'+accountId+'/'+propertyId+'/'+domain,{[csrfName]: csrfHash},function(views){
            $('.txt_csrfname').val(views.token); 
            $('#analyticsViewDrop').find('option').remove().end();

            formatElement.options[0] = new Option('Select Property View','false');

            views.response.forEach(function(element) {
      
                formatElement.options[formatElement.length] = new Option(element['name'],element['id']);
            });

            $('#loadingImageAuthentication').hide();
        });
    }


    "use strict";
    $("#analyticsViewDrop").change(function () {
        var viewID  = this.value;
        if(viewID !== 'false')
        {
            $("#authenticationBtn").attr("href", baseUrl+"analytics/getReport/"+viewID+'/'+$('#domainID').val()+'/'+$('#analyticsAccountDrop').val()+'/'+$('#analyticsPropertyDrop').val());
        }
        else
        {
            $("#authenticationBtn").removeAttr('href');
        }
    }); 

    "use strict";
    function validateInputNumbers(evt) {
        var theEvent = evt || window.event;
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } 
        else 
        {
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }

    $(document).on("change","#alexa_rank",function(){
        
        if(this.value === '1'){
            $("#alexaDiv").show();
        }
        else
        {
            $("#alexaDiv").hide();
        }
    });

    $(document).on("change","#pricing_options",function(){
        
        if(this.value === '1'){
            $("#auctionDiv").hide();
            $("#classifiedDiv").show();
        }
        else
        {
            $("#auctionDiv").show();
            $("#classifiedDiv").hide();
        }
    });

    $(document).ready(function() {
        $("input[name$='withdraw_option']").click(function() {
            var selecion = $(this).val();

            if(selecion === '1'){
                $("#PayPalDiv").show();
                $("#PayoneerDiv").hide();
                $("#EscrowDiv").hide();
                $("#WireDiv").hide();
            }
            else if(selecion === '2'){
                $("#PayPalDiv").hide();
                $("#PayoneerDiv").show();
                $("#EscrowDiv").hide();
                $("#WireDiv").hide();
            }
            else if(selecion === '3'){
                $("#PayPalDiv").hide();
                $("#PayoneerDiv").hide();
                $("#EscrowDiv").show();
                $("#WireDiv").hide();
            }
            else if(selecion === '4'){
                $("#PayPalDiv").hide();
                $("#PayoneerDiv").hide();
                $("#EscrowDiv").hide();
                $("#WireDiv").show();
            }
        });
    });

    /*--------------------------------------------------*/
    /*  Populate Active Payment Methods
    /*--------------------------------------------------*/
    "use strict";
    function populateActivePaymentMethods(platformsElementId){
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if($('#'+platformsElementId).length > 0){
            var formatElement = document.getElementById(platformsElementId);

            $.getJSON(baseUrl+'main/getSelectedSettingsData/'+'withdrawal_options',function(plans){
                plans = $.parseJSON(plans);
                plans.forEach(function(element) {
      
                    formatElement.options[formatElement.length] = new Option(element,element);
                });

            });
        }
    }

    /*--------------------------------------------------*/
    /*  Populate Currency Options
    /*--------------------------------------------------*/
    "use strict";
    function populateCurrencyOptions(platformsElementId,value='USD'){
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if($('#'+platformsElementId).length > 0){
            var formatElement = document.getElementById(platformsElementId);

            $.getJSON(baseUrl+'common/load_currency_options/',{[csrfName]: csrfHash},function(currencies){
                $('.txt_csrfname').val(currencies.token);
                currencies.response.forEach(function(element) {
                    formatElement.options[formatElement.length] = new Option(element['currency'],element['currency']);
                });
                selectElement(platformsElementId,value);
            });
        }
    }

    /*--------------------------------------------------*/
    /*  Populate List of Languages
    /*--------------------------------------------------*/
    "use strict";
    function populateLanguages(platformsElementId,value='english'){
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if($('#'+platformsElementId).length > 0){
            var formatElement = document.getElementById(platformsElementId);

            if(language ===''){
                language = 'english';
            }

            $.getJSON(baseUrl+'common/load_languages/',{[csrfName]: csrfHash},function(languages){
                $('.txt_csrfname').val(languages.token);
                languages.response.forEach(function(element) {
                    formatElement.options[formatElement.length] = new Option(element['language_code'].toUpperCase(),element['language']);
                });

                selectElement(platformsElementId,language);
            });
        }
    }

    /*$(document).ready(function(){
        $("#ot-languages").select2({
            minimumResultsForSearch: -1,
            templateResult: formatOptions
        });
    });
 
    function formatOptions (langauge) {
        if (!langauge.id) { return langauge.text; }
        var $langauge = $(
            '<span ><img sytle="display: inline-block;" src="http://pascha.org/img/'+ langauge.text + '.png" /> ' + langauge.text + '</span>'
        );

        return $langauge;
    }*/

    /*--------------------------------------------------*/
    /*  Populate List of Countries
    /*--------------------------------------------------*/
    "use strict";
    function populateListOfCountries(platformsElementId,value='US'){
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if($('#'+platformsElementId).length > 0){
            var formatElement = document.getElementById(platformsElementId);

            $.getJSON(baseUrl+'assets/data/names.json',function(countries){

                countries.forEach(function(element) {
                    $(formatElement.options).addClass('dropdown-item');
                    formatElement.options[formatElement.length] = new Option(JSON.parse(element['Country']),JSON.parse(element['alpha2']));
                    if(JSON.parse(element['alpha2']) === value){
                        selectElement(platformsElementId,value);
                    }
                });
            });
        }
    }

    /*--------------------------------------------------*/
    /*  Populate DOmain List
    /*--------------------------------------------------*/
    "use strict";
    function populateListTlds(platformsElementId,value='com'){
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if($('#'+platformsElementId).length > 0){
            var formatElement = document.getElementById(platformsElementId);

            $.getJSON(baseUrl+'assets/data/tld.json',function(tlds){
                $.map(tlds, function(value, index) {
                    formatElement.options[formatElement.length] = new Option(value,value);
                });
            });
        }
    }


    /*--------------------------------------------------*/
    /*  Select Specific item from dropdown
    /*--------------------------------------------------*/
    "use strict";
    function selectElement(id, valueToSelect) {  

        $('#'+id).val(valueToSelect);
    }

    "use strict";
    function selectIcon(valueToSelect) { 
        $('<img class=flagicon src="'+ valueToSelect +'.png">').insertAfter("#ot-languages"); 
        $(".flagicon").attr("src", 'http://pascha.org/img/'+ valueToSelect +'.png');
    }


    /*--------------------------------------------------
    |  Language Changer
    /*--------------------------------------------------*/
    $(document).on('change', '#ot-languages', function(e){  
        e.preventDefault();
        window.location.href= baseUrl+'language/'+$('#ot-languages').val();
        return;
    });


    /*--------------------------------------------------*/
    /*  Password strength checker
    /*--------------------------------------------------*/

    //minimum 8 characters
    var bad = /(?=.{8,}).*/;
    //Alpha Numeric plus minimum 8
    var good = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{8,}$/;
    //Must contain at least one upper case letter, one lower case letter and (one number OR one special char).
    var better = /^(?=\S*?[A-Z])(?=\S*?[a-z])((?=\S*?[0-9])|(?=\S*?[^\w\*]))\S{8,}$/;
    //Must contain at least one upper case letter, one lower case letter and (one number AND one special char).
    var best = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{8,}$/;

    $('#register_password').on('keyup', function () {
      var password = $(this);

      if(password ==="")
      {
        $("#register_submit").attr("disabled", true);
        $("#i_passwordcheck").toggleClass('fa-check-circle valid-icon',false);
        $("#i_passwordcheck").toggleClass('fa-times-circle invalid-icon',false);
        $("#i_passwordcheck").toggleClass('fa-check-circle',false);
        $("#i_passwordcheck").toggleClass('fa-cog fa-spin',true);
      }
      else
      {
        $("#register_submit").attr("disabled", false);
        $("#i_passwordcheck").toggleClass('fa-times-circle invalid-icon',false);
        $("#i_passwordcheck").toggleClass('fa-cog fa-spin',false);
        $("#i_passwordcheck").toggleClass('fa-check-circle valid-icon',true);

        if($("#register_repassword").val() !== "")
        {
          if($("#register_repassword").val() !== $('#register_password').val())
          {
            $("#register_submit").attr("disabled", true);
            $("#i_retypepasswordcheck").toggleClass('fa-check-circle valid-icon',false);
            $("#i_retypepasswordcheck").toggleClass('fa-cog fa-spin',false)
            $("#i_retypepasswordcheck").toggleClass('fa-times-circle invalid-icon',true);
          }
          else
          {
            $("#register_submit").attr("disabled", false);
            $("#i_retypepasswordcheck").toggleClass('fa-times-circle invalid-icon',false);
            $("#i_retypepasswordcheck").toggleClass('fa-cog fa-spin',false);
            $("#i_retypepasswordcheck").toggleClass('fa-check-circle valid-icon',true);
          }
        }

        var pass = password.val();
        var passLabel = $('[for="password"]');
        var stength = 'Weak';
        var pclass = 'danger';
        if (best.test(pass) == true) {
          stength = 'Very Strong';
          pclass = 'success';
        } else if (better.test(pass) == true) {
          stength = 'Strong';
          pclass = 'warning';
        } else if (good.test(pass) == true) {
          stength = 'Almost Strong';
          pclass = 'warning';
        } else if (bad.test(pass) == true) {
          stength = 'Weak';
        } else {
          stength = 'Very Weak';
        }

        var popover = password.attr('data-content', stength).data('bs.popover');
        popover.setContent();
        popover.$tip.addClass(popover.options.placement).removeClass('danger success info warning primary').addClass(pclass);
      }

    });

    $('input[data-toggle="popover"]').popover({
      placement: 'top',
      trigger: 'focus'
    });

    
/*--------------------------------------------------*/
/*  Valid Email Checker
/*--------------------------------------------------*/
"use strict";
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

/*--------------------------------------------------*/
/*  Disable Screen
/*--------------------------------------------------*/
"use strict";
    function disableScreen() {
        var div= document.createElement("div");
        div.className += "overlay";
        document.body.appendChild(div);
    }

/*--------------------------------------------------*/
/*  Copy URL
/*--------------------------------------------------*/
"use strict";
    $('.copy-url-button').click(function() { 
        Snackbar.show({
            text: 'Copied to clipboard!',
        }); 
    }); 

/*--------------------------------------------------*/
/*  Cookies Notice
/*--------------------------------------------------*/

    (function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        factory(require('jquery'));
    } else {
        factory(jQuery);
    }
    }(function ($) {
    var pluses = /\+/g;
    function encode(s) {
        return config.raw ? s : encodeURIComponent(s);
    }
    
    function decode(s) {
        return config.raw ? s : decodeURIComponent(s);
    }

    function stringifyCookieValue(value) {
        return encode(config.json ? JSON.stringify(value) : String(value));
    }

    function parseCookieValue(s) {
        if (s.indexOf('"') === 0) {
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }
        try {
            s = decodeURIComponent(s.replace(pluses, ' '));
            return config.json ? JSON.parse(s) : s;
        } catch(e) {}
    }

    function read(s, converter) {
        var value = config.raw ? s : parseCookieValue(s);
        return $.isFunction(converter) ? converter(value) : value;
    }
    var config = $.cookie = function (key, value, options) {
        if (value !== undefined && !$.isFunction(value)) {
            options = $.extend({}, config.defaults, options);
            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setTime(+t + days * 864e+5);
            }
            return (document.cookie = [
                encode(key), '=', stringifyCookieValue(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '',
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }
        var result = key ? undefined : {};
        var cookies = document.cookie ? document.cookie.split('; ') : [];
        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            var name = decode(parts.shift());
            var cookie = parts.join('=');
            if (key && key === name) {
                result = read(cookie, value);
                break;
            }
            if (!key && (cookie = read(cookie)) !== undefined) {
                result[name] = cookie;
            }
        }
        return result;
    };
    config.defaults = {};
    $.removeCookie = function (key, options) {
        if ($.cookie(key) === undefined) {
            return false;
        }
        $.cookie(key, '', $.extend({}, options, { expires: -1 }));
        return !$.cookie(key);
    };
    }));

    $(".close-cookie-warning").on("click", function() {
        $.cookie('HideCookieMessage', 'true', { expires: 120, path: '/'});
        $('div.cookies').hide();
    });
    (function ($) {
    if ($.cookie('HideCookieMessage')) { $('.cookies').hide(); } else {
        $('.cookies').show(); }
    })(jQuery);



