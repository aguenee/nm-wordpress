<?php
/**
 * The template for displaying all single reportage posts and attachments
 */

get_header(); ?>


<?php
// Start the loop.
while ( have_posts() ) : the_post(); ?>

<h2><?php the_title(); ?></h2>

<p>
	<?php the_content(); ?>
</p>
<!-- <?php echo get_stylesheet_directory_uri(); ?>/img/default/magazine-1.jpg) -->

<!-- pdfjs -->
<div style="width: 80%; margin: auto; display: block;">
	<div>
	  <button id="prev">Previous</button>
	  <button id="next">Next</button>
	  &nbsp; &nbsp;
	  <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
	</div>

	<div>
	  <canvas id="the-canvas" style="border:1px solid black; max-width: 100%;"></canvas>
	</div>
</div>
<?php endwhile; ?>

<!-- for legacy browsers add compatibility.js -->
<!--<script src="../compatibility.js"></script>-->

<!--<script src="<?php get_stylesheet_directory_uri() ?>/node_modules/pdfjs-dist/build/pdf.js"></script>-->

<script id="script">
  //
  // If absolute URL from the remote server is provided, configure the CORS
  // header on that server.
  //
  var url = '/wp-content/uploads/2017/01/demodoc.pdf';


  //
  // Disable workers to avoid yet another cross-origin issue (workers need
  // the URL of the script to be loaded, and dynamically loading a cross-origin
  // script does not work).
  //
  // PDFJS.disableWorker = true;

  //
  // In cases when the pdf.worker.js is located at the different folder than the
  // pdf.js's one, or the pdf.js is executed via eval(), the workerSrc property
  // shall be specified.
  //
  // PDFJS.workerSrc = '../../build/pdf.worker.js';

  var pdfDoc = null,
      pageNum = 1,
      pageRendering = false,
      pageNumPending = null,
      scale = 0.8,
      canvas = document.getElementById('the-canvas'),
      ctx = canvas.getContext('2d');

  /**
   * Get page info from document, resize canvas accordingly, and render page.
   * @param num Page number.
   */
  function renderPage(num) {
    pageRendering = true;
    // Using promise to fetch the page
    pdfDoc.getPage(num).then(function(page) {
      var viewport = page.getViewport(scale);
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      // Render PDF page into canvas context
      var renderContext = {
        canvasContext: ctx,
        viewport: viewport
      };
      var renderTask = page.render(renderContext);

      // Wait for rendering to finish
      renderTask.promise.then(function () {
        pageRendering = false;
        if (pageNumPending !== null) {
          // New page rendering is pending
          renderPage(pageNumPending);
          pageNumPending = null;
        }
      });
    });

    // Update page counters
    document.getElementById('page_num').textContent = pageNum;
  }

  /**
   * If another page rendering in progress, waits until the rendering is
   * finised. Otherwise, executes rendering immediately.
   */
  function queueRenderPage(num) {
    if (pageRendering) {
      pageNumPending = num;
    } else {
      renderPage(num);
    }
  }

  /**
   * Displays previous page.
   */
  function onPrevPage() {
    if (pageNum <= 1) {
      return;
    }
    pageNum--;
    queueRenderPage(pageNum);
  }
  document.getElementById('prev').addEventListener('click', onPrevPage);

  /**
   * Displays next page.
   */
  function onNextPage() {
    if (pageNum >= pdfDoc.numPages) {
      return;
    }
    pageNum++;
    queueRenderPage(pageNum);
  }
  document.getElementById('next').addEventListener('click', onNextPage);

  /**
   * Asynchronously downloads PDF.
   */
  PDFJS.getDocument(url).then(function (pdfDoc_) {
    pdfDoc = pdfDoc_;
    document.getElementById('page_count').textContent = pdfDoc.numPages;

    // Initial/first page rendering
    renderPage(pageNum);
  });
</script>

<?php get_footer(); ?>