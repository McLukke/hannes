<?php header("Content-type: text/css; charset: UTF-8"); ?>

<?php global $pixie_data; ?>

body {
	background-color: #fff;
	color: #333;
	font-family: serif;
	font-size: 16px;
	line-height: 1.625;

	max-width: 600px;
	margin: 0 auto;
	margin-top: 20px;
	font-family: "<?php echo urldecode( $_REQUEST[ 'font_family_1' ] ); ?>";
}
h1, h2, h3, h4, h5, h6 {
	color: #000;
	font-family: sans-serif;
	margin: 30px 0 20px;

	font-family: "<?php echo urldecode( $_REQUEST[ 'font_family_2' ] ); ?>";
}
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
	color: inherit;
}
h1 {
	font-size: 1.8em;
	line-height: 1.3;
}
h2 {
	font-size: 1.6em;
	line-height: 1.3;
}
h3 {
	font-size: 1.4em;
	line-height: 1.4;
}
h4 {
	font-size: 1.2em;
	line-height: 1.5;
}
h5 {
	font-size: 1.1em;
	line-height: 1.6;
}
h6 {
	font-size: 1em;
}
a {
	text-decoration: none;
	-webkit-transition: all 0.25s ease-in-out;
	transition: all 0.25s ease-in-out;

	color: <?php echo urldecode( $_REQUEST[ 'color_accent' ] ); ?>;
}
img {
	max-width: 100%;
	height: auto;
}
p, blockquote, ul, ol {
	margin: 20px 0;
}
figure, iframe {
	max-width: 100%;
	display: block;
}

h1 {
	letter-spacing: -0.03em;
}
h2 {
	letter-spacing: -0.03em;
}
h3 {
	letter-spacing: -0.03em;
}
h4 {
	letter-spacing: -0.03em;
}
h5 {
	letter-spacing: -0.03em;
}
h6 {
	letter-spacing: -0.03em;
}
hr {
	height: 1px;
	margin: 40px 0;
	background-color: #e9e9e9;
	border: none;
}

blockquote {
	position: relative;
	color: #aaa;
	font-size: 18px;
	font-style: italic;
	margin: 35px 0;
	padding: 30px 40px 10px;
}
blockquote:before, blockquote:after {
	content: "";
	position: absolute;
	left: 50%;
	margin-left: -80px;
	height: 1px;
	width: 160px;
	background-color: #e9e9e9;
}
blockquote:before {
	top: 0;
}
blockquote:after {
	bottom: 0;
}

.alignnone {
	margin: 5px 20px 20px 0;
}
.aligncenter,
div.aligncenter {
	display: block;
	margin: 5px auto 20px auto;
}
.alignright {
	float: right;
	margin: 5px 0 20px 20px;
}
.alignleft {
	float: left;
	margin: 5px 20px 20px 0;
}
a img.alignright {
	float: right;
	margin: 5px 0 20px 20px;
}
a img.alignnone {
	margin: 5px 20px 20px 0;
}
a img.alignleft {
	float: left;
	margin: 5px 20px 20px 0;
}
a img.aligncenter {
	display: block;
	margin-left: auto;
	margin-right: auto
}
.wp-caption {
	text-align: center;
}
.wp-caption.alignnone {
	margin: 5px 20px 20px 0;
}
.wp-caption.alignleft {
	margin: 5px 20px 20px 0;
}
.wp-caption.alignright {
	margin: 5px 0 20px 20px;
}
.wp-caption img {
	border: 0 none;
	height: auto;
	margin: 0;
	max-width: 98.5%;
	padding: 0;
	width: auto;
}
.wp-caption-text {
	margin: 0;
	padding: 0;
	color: #aaa;
	font-size: 11px;
	font-style: italic;
}
.size-auto, 
.size-full,
.size-large,
.size-medium,
.size-thumbnail {
	max-width: 100%;
	height: auto;
}

.side-background-source {
	opacity: 0.4;
	width: 100px;
}
@media ( min-width: 860px ) {
	.side-background-source {
		position: absolute;
		margin-left: -130px !important;
	}
}