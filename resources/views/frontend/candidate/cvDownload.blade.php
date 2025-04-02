<div>
<button class="btn btn-primary" id="jsPrintAll"><i class="fa fa-print" aria-hidden="true"></i> Download Resume</button>
 <div id="renderHtml">

 </div>

</div>
<style>
    @media print {
        .print {
            background: white;
            z-index: 1;
            margin: 0;
            -webkit-print-color-adjust: exact;
        }

        body {
            -webkit-print-color-adjust: exact;
        }

        .header-area,
        .page-header-area,
        .no-print {
            display: none;
        }
    }
</style>
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<script>
    document
        .getElementById("jsPrintAll")
        .addEventListener("click", function download() {
            const element = document.getElementById("print");
            console.log(element);
             html2pdf( element,{html2canvas:  { scale: 4 }, filename: 'resume'})
        });

    function putDataOnModel() {
        const element =window.localStorage.getItem('cvDownload');
        document.getElementById('renderHtml').innerHTML = element;
        setTimeout(function(){
            document.querySelector('#jsPrintAll').click();
        },500);
    }
    putDataOnModel() ;
</script>