import sys
import pytesseract
from PyPDF2 import PdfReader
from PIL import Image

file_path = sys.argv[1]

print(f"Procesando archivo: {file_path}")

# Función para limpiar saltos de línea y unir el texto
def clean_text(text):
    # Elimina saltos de línea y los reemplaza por espacios
    cleaned_text = text.replace('\n', ' ').replace('\r', ' ')
    # Elimina dobles espacios que puedan quedar
    cleaned_text = ' '.join(cleaned_text.split())
    return cleaned_text

def process_pdf(file_path):
    reader = PdfReader(file_path)
    text = ""
    for page in reader.pages:
        text += page.extract_text()
    return clean_text(text)  # Limpiar el texto extraído

def process_image(file_path):
    img = Image.open(file_path)
    text = pytesseract.image_to_string(img)
    return clean_text(text)  # Limpiar el texto extraído

# Determina si es un PDF o una imagen
if file_path.endswith(".pdf"):
    extracted_text = process_pdf(file_path)
    print(f"Texto extraído del PDF: {extracted_text}")
else:
    extracted_text = process_image(file_path)
    print(f"Texto extraído de la imagen: {extracted_text}")

# Verifica si se ha podido extraer texto
if not extracted_text:
    print("No se pudo extraer ningún texto.")
else:
    print("Texto extraído correctamente.")
