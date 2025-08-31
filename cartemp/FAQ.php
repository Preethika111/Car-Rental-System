<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FAQs - Car Rental Portal</title>
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px;
        }

        h1 {
            text-align: center;
            color: #58a6ff;
            margin-bottom: 30px;
        }

        .faq-container {
            max-width: 800px;
            margin: auto;
        }

        .search-box {
            text-align: center;
            margin-bottom: 30px;
        }

        .search-box input {
            padding: 10px;
            width: 60%;
            border: 1px solid #30363d;
            border-radius: 5px;
            background-color: #0d1117;
            color: #c9d1d9;
        }

        .search-box button {
            padding: 10px 15px;
            background-color: #238636;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
        }

        .search-box button:hover {
            background-color: #2ea043;
        }

        .faq {
            background-color: #161b22;
            border: 1px solid #30363d;
            border-radius: 8px;
            margin-bottom: 10px;
            overflow: hidden;
        }

        .faq-question {
            padding: 15px 20px;
            cursor: pointer;
            font-weight: bold;
            position: relative;
        }

        .faq-answer {
            display: none;
            padding: 0 20px 15px;
            line-height: 1.6;
        }

        .not-found {
            text-align: center;
            margin-top: 20px;
            color: #f85149;
        }
    </style>
</head>
<body>
    <h1>Frequently Asked Questions</h1>

    <div class="faq-container">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search your question...">
            <button onclick="searchFAQ()">Search</button>
        </div>

        <div id="faqs">
            <div class="faq">
                <div class="faq-question">How do I book a car?</div>
                <div class="faq-answer">You can book a car by logging in, browsing available cars, and clicking the "Book Now" button.</div>
            </div>
            <div class="faq">
                <div class="faq-question">What documents are required for renting?</div>
                <div class="faq-answer">You'll need a valid driving license, a government-issued ID, and proof of payment.</div>
            </div>
            <div class="faq">
                <div class="faq-question">Can I cancel my booking?</div>
                <div class="faq-answer">Yes, bookings can be cancelled up to 24 hours before pickup. Cancellation charges may apply.</div>
            </div>
            <div class="faq">
                <div class="faq-question">Is there a late return fee?</div>
                <div class="faq-answer">Yes, late returns will be charged based on hourly rates mentioned in your rental agreement.</div>
            </div>
            <div class="faq">
                <div class="faq-question">Do you offer roadside assistance?</div>
                <div class="faq-answer">Yes, 24/7 roadside assistance is included with all our rentals.</div>
            </div>
        </div>

        <div class="not-found" id="notFound" style="display: none;">
            No matching question found. 
            <button onclick="window.location.href='support.php'" style="margin-left: 10px;">Contact Support</button>
        </div>
    </div>

    <script>
        const faqs = document.querySelectorAll(".faq");

        faqs.forEach(faq => {
            faq.querySelector(".faq-question").addEventListener("click", () => {
                const answer = faq.querySelector(".faq-answer");
                answer.style.display = answer.style.display === "block" ? "none" : "block";
            });
        });

        function searchFAQ() {
            const query = document.getElementById("searchInput").value.toLowerCase();
            const faqElements = document.querySelectorAll(".faq");
            let found = false;

            faqElements.forEach(faq => {
                const question = faq.querySelector(".faq-question").textContent.toLowerCase();
                const answer = faq.querySelector(".faq-answer");

                if (question.includes(query)) {
                    faq.style.display = "block";
                    answer.style.display = "block";
                    found = true;
                } else {
                    faq.style.display = "none";
                }
            });

            document.getElementById("notFound").style.display = found ? "none" : "block";
        }
    </script>
</body>
</html>
