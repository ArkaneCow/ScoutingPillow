args <- commandArgs(trailingOnly = TRUE)
data_input <- "test.csv"
png_output <- "out.png"
rm(args)

data <- read.csv(data_input, header=TRUE)
plot(data[,2]);
res <- lm(as.formula(paste(colnames(data)[2], "~ c(1:length(data[,2]))")), data=data)
abline(res)

