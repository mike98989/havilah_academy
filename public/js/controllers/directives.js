
//// INFORMATION GATHERING ////
    module.factory('infogathering', ['$http','$cookies', function($http, $cookies) {
    var siteUrl = window.location.pathname;
    var webUrl= siteUrl.split("/");
    //splice the url to fit in both on localhost and onine server
    var i = webUrl.indexOf('fcda');
    webUrl.splice(i, 1);

    //var dirlocation = window.location.hostname+'/nps/';
    //var dirlocation = window.location.hostname+'/';
    //var completeUrlLocation = 'https://'+window.location.hostname+'/';
    var completeUrlLocation = 'http://'+window.location.hostname+'/fcda/';
    //var completeUrlLocation = 'http://'+window.location.hostname+'/';
    //var current_user = $('#current_user_value').val();

    return {urlSplit:webUrl, completeUrlLocation:completeUrlLocation}
    }])



module.filter('HTML2TXT', function($sce){
    return function(msg) { 
        var RexStr = /\<|\>|\"|\'|\&/g;
        msg = (msg + '').replace(RexStr,
            function(MatchStr){
                switch(MatchStr){
                    case "<":
                        return "&lt;";
                        break;
                    case ">":
                        return "&gt;";
                        break;
                    case "\"":
                        return "&quot;";
                        break;
                    case "'":
                        return "&#39;";
                        break;
                    case "&":
                        return "&amp;";
                        break;
                    default :
                        break;
                }
            }
        )
        return $sce.trustAsHtml(msg);
    }
})



module.filter('htmlToPlaintext', function()
{
    return function(text)
    {
        return  text ? String(text).replace(/<[^>]+>/gm, '') : '';
    };
});


module.filter('reverse', function () {
    return function(items) {
        return items.slice().reverse();
    };
});




