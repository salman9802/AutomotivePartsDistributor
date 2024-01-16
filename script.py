import pandas as pd

parts = pd.read_csv('part-details.csv')
queries = ""
for _,row in parts.iterrows():
    brand = row['part_brand']
    model = row['part_model']
    type = row['part_type']
    name = row['part_name']
    price = row['part_price']
    image = row['part_image']
    status = "instock"
    queries += f"INSERT INTO parts(brand, model, type, name, price, image, status) VALUES ('{str(brand).lstrip().rstrip()}','{str(model).lstrip().rstrip()}','{str(type).lstrip().rstrip()}','{str(name).lstrip().rstrip()}','{str(price).lstrip().rstrip()}','{str(image).lstrip().rstrip()}','{str(status).lstrip().rstrip()}');\n"

# print(queries)

with open('generated-queries.txt', 'w') as f:
    f.write(queries)



# INSERT INTO parts(brand, model, type, name, price, image, status) VALUES ('{brand}','{model}','{type}','{name}','{price}','{image}','{status}')

# INSERT INTO parts(brand, model, type, name, price, image, status) VALUES (':brand',':model',':type',':name',':price',':image',':status')