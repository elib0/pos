(function(w){
	var jq={};
	w.jQuerySwitch=function(name,val){
		if(val)	jq[name]=val;
		w.$=w.jQuery=jq[name];
		return jq[name];
	};
	w.jQ=function(name){
		return jq[name]||w.jQuery;
	};
})(window);
