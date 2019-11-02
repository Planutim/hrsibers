import os


dir_path = os.path.dirname(os.path.realpath(__file__))
filenames = []
for root, dirs, files in os.walk(dir_path):
	for file in files:
		if file.endswith('.php'):
		#if str(file)=='*.txt':
			#print root+"/"+str(file)
			filenames.append(root+"/"+str(file))

with open('result.txt', 'wb') as outfile:
	for fname in filenames:
		with open(fname) as infile:
			outfile.write(infile.read())
			outfile.write('\n')

