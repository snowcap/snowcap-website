if (beresp.http.Surrogate-Control ~ "ESI/1.0") {
    unset beresp.http.Surrogate-Control;

    set beresp.do_esi = true;
}

if (req.url ~ "\.(ico|ttf|woff|png|gif|jpg|swf|css|js)$") {
   unset beresp.http.set-cookie;
   set beresp.ttl = 1d;
}
