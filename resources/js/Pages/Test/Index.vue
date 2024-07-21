<script setup>

</script>

<template>

    CREATE
    <form method="POST" action="/create-price">
        @csrf
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="text" name="description" placeholder="Product Description">
        <input type="number" name="amount" placeholder="Amount (in cents)" required>
        <input type="text" name="currency" placeholder="Currency (e.g., USD)" required>
        <select name="interval" required>
            <option value="day">Day</option>
            <option value="week">Week</option>
            <option value="month">Month</option>
            <option value="year">Year</option>
        </select>
        <button type="submit">Create Price</button>
    </form>


    UPDATE
    <form method="POST" action="/update-price">
    @csrf
    <input type="text" name="price_id" placeholder="Price ID" required>
    <input type="number" name="amount" placeholder="New Amount (in cents)" required>
    <input type="text" name="currency" placeholder="Currency (e.g., USD)" required>
    <select name="interval" required>
        <option value="day">Day</option>
        <option value="week">Week</option>
        <option value="month">Month</option>
        <option value="year">Year</option>
    </select>
    <button type="submit">Update Price</button>
</form>




</template>