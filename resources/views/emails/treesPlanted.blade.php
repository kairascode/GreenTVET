<p>A new tree planting has been recorded:</p>
<ul>
    <li>Institution: {{ $treePlanting->institution->name }}</li>
    <li>Species: {{ $treePlanting->treeSpecies->name }}</li>
    <li>Quantity: {{ $treePlanting->quantity_planted }}</li>
    <li>Date: {{ $treePlanting->planting_date }}</li>
</ul>