<h3>wp.Backbone.View</h3>
<p>An extension of <code>Backbone.View</code>. All views in WordPress are built on top of this. A Subview Manager is baked in via <code>wp.Backbone.Subviews</code>.</p>
<div class="example">
	<h3>Example: Render a view with a subview</h3>
	<h4>LIVE EXAMPLE</h4>
	<div class="live-example">
		<div class="view-1-container"></div>
		<button class="js--render-view-1">Click to render the parent view</button>
		<script type="text/template" id="tmpl-view-1">
			A view template.
			<div class="subview-container"></div>
		</script>
		<script type="text/template" id="tmpl-view-2">
			A subview template.
		</script>
	</div>
	<h4>TEMPLATE MARKUP</h4>
<pre><code class="language-html">&lt;script type=&quot;text/template&quot; id=&quot;tmpl-view-1&quot;&gt;
	A view template.
	&lt;div class=&quot;subview-container&quot;&gt;&lt;/div&gt;
&lt;/script&gt;
&lt;script type=&quot;text/template&quot; id=&quot;tmpl-view-2&quot;&gt;
	A subview template.
&lt;/script&gt;</code></pre>
		<p>An element goes in a view where a subview will be rendered (here <code>.subview-container</code>).</p>
		<p><code>wp.template()</code> will find templates where <code>id="tmpl-{...}"</code>, so ID templates accordingly.</p>
		<p><code>wp.template()</code> expects Mustache-inspired templating tags (see <a href="http://core.trac.wordpress.org/ticket/22344">#22344</a>), so use them:
			<blockquote>
			<code>{{{ interpolating }}}</code>,<code>{{ 'escaping' }}</code>,<code><# execution #></code>
		</blockquote>
		</p>
		<h4>JAVASCRIPT</h4>
<pre><code class="language-javascript">$(document).ready( function() {
	// Create view and subview constructors.
	var ViewConstructor = wp.Backbone.View.extend({
		// assign a compiled template function.
		template: wp.template( &#039;view-1&#039; )
	});
	var SubviewConstructor = wp.Backbone.View.extend({
		template: wp.template( &#039;view-2&#039; )
	});

	// Create the views.
	var View = new ViewConstructor({
		// specify an existing element in the document to bind the view to.
		el: &#039;.view-1-container&#039;
	});
	var Subview = new SubviewConstructor();

	// Set the subview on a selector inside the main view&#039;s template.
	View.views.set( &#039;.subview-container&#039;, Subview );

	$(&#039;.js--render-view-1&#039;).on( &#039;click&#039;, function() {
		// When a parent view is rendered, all subviews are rendered automagically.
		View.render();
	});
});</code></pre>
	<h4>IN-PAGE MARKUP</h4>
<pre><code class="language-html">&lt;div class=&quot;view-1-container&quot;&gt;&lt;/div&gt;
&lt;button class=&quot;js--view-1-render&quot;&gt;Click to render the parent view&lt;/button&gt;
</code></pre>
</div>