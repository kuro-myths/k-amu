import os
from PIL import Image, ImageDraw
import struct

# Create favicon images
def create_favicon_images():
    # Create main image 512x512
    img = Image.new('RGBA', (512, 512), (255, 255, 255, 255))
    draw = ImageDraw.Draw(img)
    
    # Colors
    dark_color = (26, 26, 26)  # #1a1a1a
    light_color = (232, 232, 232)  # #e8e8e8
    accent_color = (79, 70, 229)  # #4f46e5
    
    # Draw K letter - left dark part
    # Vertical line
    draw.line([(128, 50), (128, 462)], fill=dark_color, width=40)
    
    # Top diagonal
    draw.line([(128, 50), (300, 256)], fill=dark_color, width=40)
    
    # Bottom diagonal
    draw.line([(128, 462), (300, 256)], fill=dark_color, width=40)
    
    # Right side - light color
    draw.line([(300, 256), (384, 50)], fill=light_color, width=40)
    draw.line([(300, 256), (384, 462)], fill=light_color, width=40)
    
    # Save different sizes
    # 512x512
    img.save('public/favicon-512x512.png')
    
    # 256x256
    img_256 = img.resize((256, 256), Image.Resampling.LANCZOS)
    img_256.save('public/favicon-256x256.png')
    
    # 32x32
    img_32 = img.resize((32, 32), Image.Resampling.LANCZOS)
    img_32.save('public/favicon-32x32.png')
    
    # 16x16
    img_16 = img.resize((16, 16), Image.Resampling.LANCZOS)
    img_16.save('public/favicon-16x16.png')
    
    # apple-touch-icon 180x180
    img_apple = img.resize((180, 180), Image.Resampling.LANCZOS)
    img_apple.save('public/apple-touch-icon.png')
    
    # For favicon.ico - use 32x32
    img_16.save('public/favicon.ico')
    
    print("✅ Favicon images created successfully!")
    print("   - favicon.ico")
    print("   - favicon-16x16.png")
    print("   - favicon-32x32.png")
    print("   - favicon-256x256.png")
    print("   - favicon-512x512.png")
    print("   - apple-touch-icon.png")

if __name__ == "__main__":
    create_favicon_images()
