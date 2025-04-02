<div>
<button class="btn btn-primary" id="jsPrintAll"><i class="fa fa-print" aria-hidden="true"></i> Download Resume</button>
@include('frontend.cvthemes.template1')

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
            html2pdf()
                .from(element)
                .save('Resume_Preview');
        });

    function putDataOnModel() {
        const element = document.getElementById("print");
        // $('.mbdy').html(element)
    }
</script>