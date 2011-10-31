set req.http.Surrogate-Capability = "abc=ESI/1.0";

if (req.url ~ "\.(ico|ttf|woff|png|gif|jpg|swf|css|js)$") {
    unset req.http.cookie;
	return (lookup);
}
