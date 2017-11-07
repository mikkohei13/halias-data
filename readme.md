
# Long term data from the Hanko Bird Observatory (Halias)

This repository contains long-term bird observation data from Hanko Bird Observatory, with some tools to work with the data.

The data is licensed under **Creative Commons Attribution 4.0 International** (CC BY 4.0) byt the Ornithological Society of Helsinki Tringa. See [LICENSE.md] for details.

Statistics about the data:
- 572033 occurrence records (rows)
- 398 taxa (including informal 'taxa' like 'Unidentified Large Crow')

## Notes

Convert data from MACINTOSH encoding to UTF8:

    iconv -f MACINTOSH -t UTF8 data.csv > data-utf8.csv

