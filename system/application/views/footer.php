                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>

            <!--div class="footer">
                - <a href="#"><?=lang('Soon to be opensourced!!')?></a>
            </div-->

            <div class="footer small">
                &copy;2010 Peyar.in
            </div>
        </div>
    </body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>

<script src="http://www.google.com/jsapi?key=AIzaSyA5m1Nc8ws2BbmPRwKu5gFradvD_hgq6G0" type="text/javascript"></script>
<script type="text/javascript">
/*
*  How to setup a textarea that allows typing with a Russian Virtual Keyboard.
*/

google.load("elements", "1", {packages: "keyboard"});

function onLoad() {

  var kbd = new google.elements.keyboard.Keyboard(
      [google.elements.keyboard.LayoutCode.TAMIL_PHONETIC],
      ['search']);
}

google.setOnLoadCallback(onLoad);

</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8359090-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript" charset="utf-8">
  var is_ssl = ("https:" == document.location.protocol);
  var asset_host = is_ssl ? "https://s3.amazonaws.com/getsatisfaction.com/" : "http://s3.amazonaws.com/getsatisfaction.com/";
  document.write(unescape("%3Cscript src='" + asset_host + "javascripts/feedback-v2.js' type='text/javascript'%3E%3C/script%3E"));
</script>

<script type="text/javascript" charset="utf-8">
  var feedback_widget_options = {};

  feedback_widget_options.display = "overlay";
  feedback_widget_options.company = "peyar";
  feedback_widget_options.placement = "right";
  feedback_widget_options.color = "#222";
  feedback_widget_options.style = "question";

  var feedback_widget = new GSFN.feedback_widget(feedback_widget_options);
</script>
</html>
