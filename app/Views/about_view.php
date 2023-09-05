<html>
<head>
    <title>{blog_title}</title>
</head>
<body>
    <h3>{blog_heading}</h3>
    <h2>{blog_title|upper}</h2>
		<h1>{currency|local_currency(inr)}</h1>
		{phone|hidenumber(6)}
    {blog_entries}
		
        <h5>{title}</h5>
        <p>{body}</p>
    {/blog_entries}
	
	{if $role=='admin'}
    <h1>Welcome, Admin!</h1>
    {endif}

</body>
</html>