<!DOCTYPE html>
<html>
<head>
    <title>Electricity Bill Calculator</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: 1px solid #ddd;
        }
        h1 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
            font-size: 24px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 8px;
            color: #495057;
            font-weight: bold;
        }
        select, input[type="number"], button {
            margin-bottom: 20px;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ced4da;
            border-radius: 6px;
        }
        select, input[type="number"] {
            background-color: #fff;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
            padding: 12px;
            font-size: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        button:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        #result {
            font-size: 18px;
            color: #495057;
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            background: #e9ecef;
            border: 1px solid #dee2e6;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Electricity Bill Calculator</h1>
        <form id="billForm">
            @csrf
            <label for="tariff">Tariff:</label>
            <select name="tariff" id="tariff">
                @foreach ($tariffs as $tariff)
                    <option value="{{ $tariff->id }}">{{ $tariff->name }}</option>
                @endforeach
            </select>

            <label for="purpose">Purpose:</label>
            <select name="purpose" id="purpose">
                @foreach ($purposes as $purpose)
                    <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                @endforeach
            </select>

            <label for="bill_cycle">Bill Cycle:</label>
            <select name="bill_cycle" id="bill_cycle">
                <option value="2 months">2 months</option>
            </select>

            <label for="consumed_units">Consumed Units:</label>
            <input type="number" name="consumed_units" id="consumed_units" required>

            <label for="phase">Phase:</label>
            <select name="phase" id="phase">
                <option value="single">Single</option>
            </select>

            <button type="submit">Submit</button>
        </form>

        <div id="result"></div>
    </div>

    <script>
        $('#billForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/calculate',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#result').html('Total Amount: Rs ' + response.charge.toFixed(2));
                },
                error: function(xhr) {
                    $('#result').html('Error: ' + xhr.responseJSON.error);
                }
            });
        });
    </script>
</body>
</html>
