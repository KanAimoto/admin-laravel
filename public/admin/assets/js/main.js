var siteURLAdmin = "http://prov.local/admin";

function changeUserInform() {
	_url = location.href;
    _url += (_url.split('?')[1] ? '&':'?') + q=1;
    return _url;
}

